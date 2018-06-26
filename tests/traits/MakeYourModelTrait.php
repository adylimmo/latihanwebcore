<?php

use Faker\Factory as Faker;
use App\Models\YourModel;
use App\Repositories\YourModelRepository;

trait MakeYourModelTrait
{
    /**
     * Create fake instance of YourModel and save it in database
     *
     * @param array $yourModelFields
     * @return YourModel
     */
    public function makeYourModel($yourModelFields = [])
    {
        /** @var YourModelRepository $yourModelRepo */
        $yourModelRepo = App::make(YourModelRepository::class);
        $theme = $this->fakeYourModelData($yourModelFields);
        return $yourModelRepo->create($theme);
    }

    /**
     * Get fake instance of YourModel
     *
     * @param array $yourModelFields
     * @return YourModel
     */
    public function fakeYourModel($yourModelFields = [])
    {
        return new YourModel($this->fakeYourModelData($yourModelFields));
    }

    /**
     * Get fake data of YourModel
     *
     * @param array $postFields
     * @return array
     */
    public function fakeYourModelData($yourModelFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $yourModelFields);
    }
}
