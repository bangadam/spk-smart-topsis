<?php namespace Tests\Repositories;

use App\Models\Criteria;
use App\Repositories\CriteriaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CriteriaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CriteriaRepository
     */
    protected $criteriaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->criteriaRepo = \App::make(CriteriaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_criteria()
    {
        $criteria = Criteria::factory()->make()->toArray();

        $createdCriteria = $this->criteriaRepo->create($criteria);

        $createdCriteria = $createdCriteria->toArray();
        $this->assertArrayHasKey('id', $createdCriteria);
        $this->assertNotNull($createdCriteria['id'], 'Created Criteria must have id specified');
        $this->assertNotNull(Criteria::find($createdCriteria['id']), 'Criteria with given id must be in DB');
        $this->assertModelData($criteria, $createdCriteria);
    }

    /**
     * @test read
     */
    public function test_read_criteria()
    {
        $criteria = Criteria::factory()->create();

        $dbCriteria = $this->criteriaRepo->find($criteria->id);

        $dbCriteria = $dbCriteria->toArray();
        $this->assertModelData($criteria->toArray(), $dbCriteria);
    }

    /**
     * @test update
     */
    public function test_update_criteria()
    {
        $criteria = Criteria::factory()->create();
        $fakeCriteria = Criteria::factory()->make()->toArray();

        $updatedCriteria = $this->criteriaRepo->update($fakeCriteria, $criteria->id);

        $this->assertModelData($fakeCriteria, $updatedCriteria->toArray());
        $dbCriteria = $this->criteriaRepo->find($criteria->id);
        $this->assertModelData($fakeCriteria, $dbCriteria->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_criteria()
    {
        $criteria = Criteria::factory()->create();

        $resp = $this->criteriaRepo->delete($criteria->id);

        $this->assertTrue($resp);
        $this->assertNull(Criteria::find($criteria->id), 'Criteria should not exist in DB');
    }
}
