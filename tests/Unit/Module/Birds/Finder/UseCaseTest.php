<?php

namespace Tests\Unit\Module\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\DucksInterface;
use App\Lake\Modules\Birds\Finder\Inputs\LakeInput;
use App\Lake\Modules\Birds\Finder\Outputs\LakeOutput;
use App\Lake\Modules\Birds\Finder\LakeUseCase;
use App\Lake\Modules\Generics\Outputs\Errors\ErrorOutput;
use App\Lake\Modules\Generics\Outputs\StatusOutput;
use App\Repositories\NotIsADuckRepository;
use App\Repositories\YellowDuckRepository;
use Core\Modules\Generics\Enums\ResponseEnum;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class UseCaseTest extends TestCase
{
    public function testYellowDuckSuccess()
    {
        $repositoryMock = new YellowDuckRepository();
        $loggerInterface = $this->createMock(LoggerInterface::class);
        $useCase = new LakeUseCase($repositoryMock, $loggerInterface);
        $useCase->execute(new LakeInput());

        $expectedResponse = new LakeOutput(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getYellowDuckQuantity()
        );

        $this->assertInstanceOf(LakeOutput::class, $expectedResponse);
        $this->assertEquals($expectedResponse, $useCase->getOutput());
    }

    public function testIsNotADuckSuccess()
    {
        $repositoryMock = new NotIsADuckRepository();
        $loggerInterface = $this->createMock(LoggerInterface::class);
        $useCase = new LakeUseCase($repositoryMock, $loggerInterface);
        $useCase->execute(new LakeInput());

        $expectedResponse = new LakeOutput(
            StatusBoot::getSuccessStatus(),
            BirdBoot::getIsNotADuckQuantity()
        );

        $this->assertInstanceOf(LakeOutput::class, $expectedResponse);
        $this->assertEquals($expectedResponse, $useCase->getOutput());
    }

    public function testFindBirdsDatabaseException()
    {
        $repositoryMock = $this->createMock(DucksInterface::class);
        $repositoryMock->expects($this->exactly(1))->method('countDucks')->willThrowException(new CountDucksDatabaseException());
        $loggerInterface = $this->createMock(LoggerInterface::class);
        $useCase = new LakeUseCase($repositoryMock, $loggerInterface);
        $useCase->execute(new LakeInput());

        $expectedResponse = new ErrorOutput(
            StatusBoot::getFailureStatus(),
            'An error occurred while search for birds.',
            'BIRDS::FINDER::DUCKS_DATABASE_EXCEPTION'
        );

        $this->assertInstanceOf(ErrorOutput::class, $expectedResponse);
        $this->assertEquals($expectedResponse, $useCase->getOutput());
    }
}

Class StatusBoot
{
    public static function getSuccessStatus(): StatusOutput
    {
        return new StatusOutput(ResponseEnum::OK, 'Ok');
    }

    public static function getFailureStatus(): StatusOutput
    {
        return new StatusOutput(ResponseEnum::INTERNAL_SERVER_ERROR, 'Internal Server Error');
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
