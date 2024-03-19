<?php

namespace App\Managers\ParseRSS;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class ParsedPostsManager
{
    /**
     * @param Collection $parsedPosts
     * @return void
     */
    public function storePosts(Collection $parsedPosts)
    {
        $user = User::find(1);

        foreach ($parsedPosts as $parsedPost)
        {
            // checkUnique and check if we have description
            if ($this->isUniqueGuid($parsedPost['guid']) && $parsedPost['description'] !== '')
            {
                try {
                    $category = $this->addCategory($parsedPost['category']);

                    $post = new Post();
                    $post->title = $parsedPost['title'];
                    $post->guid = $parsedPost['guid'];
                    $post->description = $parsedPost['description'];
                    $post->thumbnail = $parsedPost['thumbnail'];
                    $post->content = $parsedPost['content'];
                    $post->link = $parsedPost['link'];
                    $post->slug = $parsedPost['slug'];
                    $post->user_id = $user->id;
                    $post->category_id = $category->id;
                    $post->save();

                    // $imageName = $this->uploadImage($feedPost->getImage());
                    // $this->feedRepository->storeImage($post, $imageName);

                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
        }
    }

    /**
     * @param string $guid
     */
    public function isUniqueGuid(string $guid)
    {
        return (Post::where('guid',$guid)->first()) ? false : true;
    }

    /**
     * @param string $categoryTitle
     * @return Category
     */
    private function addCategory(string $categoryTitle)
    {
        $category = Category::where('name', $categoryTitle)->first();
        if (!$category) {
            $category = new Category();
            $category->name = $categoryTitle;
            $category->slug = $this->makeSlug($categoryTitle);
            $category->save();
        }
        return $category;
    }

    /**
     * @param string $string
     * @return string
     */
    public function makeSlug(string $string): string
    {
        $slug = strtolower($string);
        $slug = preg_replace('/[^a-z0-9-_\s]/', '', $slug);
        $slug = str_replace(' ', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        return $slug;
    }
}
