<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="NUS API Documentation",
 *      description="NUS Swagger OpenApi description",
 *      @OA\Contact(
 *          email="ryanhaidypapudi@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="Bearer",
 *      bearerFormat="JWT",
 * ),
 */

/**
 * @OA\Parameter(
 *     parameter="pagination-page",
 *     name="page",
 *     in="query",
 *     description="The current page for the result set, defaults to *1*",
 *     required=false,
 *     @OA\Schema(
 *         type="integer",
 *         default=1,
 *     )
 * ),
 * @OA\Parameter(
 *     parameter="pagination-per-page",
 *     name="per_page",
 *     in="query",
 *     description="The total data per page for the result set, defaults to *10*",
 *     required=false,
 *     @OA\Schema(
 *         type="integer",
 *         default=10,
 *     )
 * ),
 * @OA\Parameter(
 *     parameter="pagination-sort-by",
 *     name="sort_by",
 *     in="query",
 *     description="The value used for sorting the result set, defaults to *created_at*",
 *     required=false,
 *     @OA\Schema(
 *         type="string",
 *         default="created_at",
 *     )
 * ),
 * @OA\Parameter(
 *     parameter="pagination-sort-dir",
 *     name="sort_dir",
 *     in="query",
 *     description="The direction of sorting for the result set, defaults to *desc*",
 *     required=false,
 *     @OA\Schema(
 *         type="integer",
 *         default="desc",
 *     )
 * ),
 */

/**
 * @OA\ExternalDocumentation(
 *     description="Find out more about Swagger",
 *     url="http://swagger.io"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
}
