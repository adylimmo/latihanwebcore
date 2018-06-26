<?php

namespace App\Repositories;

use App\Models\YourModel;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class YourModelRepository
 * @package App\Repositories
 * @version June 26, 2018, 4:47 pm UTC
 *
 * @method YourModel findWithoutFail($id, $columns = ['*'])
 * @method YourModel find($id, $columns = ['*'])
 * @method YourModel first($columns = ['*'])
*/
class YourModelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return YourModel::class;
    }
}
