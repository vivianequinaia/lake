<?php

namespace Tests\Unit\Module\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\CountDucksGateway;
use App\Lake\Modules\Birds\Finder\Responses\Response;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\UseCase;
use App\Repositories\NotIsADuckRepository;
use App\Repositories\YellowDuckRepository;

class UseCaseTest extends \PHPUnit\Framework\TestCase
{
    public function testYellowDuckSuccess()
    {
        $repositoryMock = new YellowDuckRepository();
        $useCase = new UseCase($repositoryMock);
        $useCase->execute();

        $expectedResponse = new Response(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getYellowDuckQuantity()
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }

    public function testIsNotADuckSuccess()
    {
        $repositoryMock = new NotIsADuckRepository();
        $useCase = new UseCase($repositoryMock);
        $useCase->execute();

        $expectedResponse = new Response(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getIsNotADuckQuantity()
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }

    public function testFindBirdsDatabaseException()
    {
        $repositoryMock = $this->createMock(CountDucksGateway::class);
        $repositoryMock->expects($this->exactly(1))->method('countDucks')->willThrowException(new CountDucksDatabaseException());
        $useCase = new UseCase($repositoryMock);
        $useCase->execute();

        $expectedResponse = new \App\Lake\Modules\Birds\Finder\Responses\Errors\Response(
            StatusBoot::getFailureStatus(),
            'An error occurred while search for birds.'
        );

        $this->assertEquals($expectedResponse, $useCase->getResponse());
    }
}

Class StatusBoot
{
    public static function getSuccessStatus(): Status
    {
        return new Status(200, 'Ok');
    }

    public static function getFailureStatus(): Status
    {
        return new Status(500, 'Internal Server Error');
    }
}

Class BirdBoot
{
    public static function getYellowDuckQuantity(): Duck
    {
        return new Duck(2);
    }

    public static function getIsNotADuckQuantity(): Duck
    {
        return new Duck(3);
    }
}
