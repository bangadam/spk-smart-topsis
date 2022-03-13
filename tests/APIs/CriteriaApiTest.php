<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Criteria;

class CriteriaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_criteria()
    {
        $criteria = Criteria::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/criterias', $criteria
        );

        $this->assertApiResponse($criteria);
    }

    /**
     * @test
     */
    public function test_read_criteria()
    {
        $criteria = Criteria::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/criterias/'.$criteria->id
        );

        $this->assertApiResponse($criteria->toArray());
    }

    /**
     * @test
     */
    public function test_update_criteria()
    {
        $criteria = Criteria::factory()->create();
        $editedCriteria = Criteria::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/criterias/'.$criteria->id,
            $editedCriteria
        );

        $this->assertApiResponse($editedCriteria);
    }

    /**
     * @test
     */
    public function test_delete_criteria()
    {
        $criteria = Criteria::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/criterias/'.$criteria->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/criterias/'.$criteria->id
        );

        $this->response->assertStatus(404);
    }
}
