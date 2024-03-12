<?php

namespace App\Lake\Modules\Birds\Finder;

use App\Lake\Modules\Birds\Finder\Enums\ErrorCodeEnum;
use App\Lake\Modules\Birds\Finder\Inputs\LakeInput;
use App\Lake\Modules\Birds\Finder\Rulesets\LakeRuleset;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\DucksInterface;
use App\Lake\Modules\Birds\Finder\Rules\CountDucksRule;
use App\Lake\Modules\Generics\Outputs\Errors\ErrorOutput;
use App\Lake\Modules\Generics\Outputs\Interfaces\OutputInterface;
use App\Lake\Modules\Generics\Outputs\StatusOutput;
use Core\Modules\Generics\Enums\ResponseEnum;
use Psr\Log\LoggerInterface;

final class LakeUseCase
{
    private DucksInterface $countDucksGateway;
    private OutputInterface $output;
    private LoggerInterface $logger;

    public function __construct(DucksInterface $countDucksGateway, LoggerInterface $logger)
    {
        $this->countDucksGateway = $countDucksGateway;
    }

    public function execute(LakeInput $input)
    {
        try {
            $this->logger->info('[Birds::Finder] Init use case.');
            $this->output = (new LakeRuleset(
                new CountDucksRule($this->countDucksGateway)
            ))->apply();
            $this->logger->info('[Birds::Finder] Finish use case.');
        } catch (CountDucksDatabaseException $exception) {
            $this->output = new ErrorOutput(
                new StatusOutput(ResponseEnum::INTERNAL_SERVER_ERROR, 'Internal Server Error'),
                ErrorCodeEnum::BIRDS__FINDER__DUCKS_DATABASE_EXCEPTION,
                'BIRDS::FINDER::DUCKS_DATABASE_EXCEPTION'
            );
            $this->logger->error(
                '[Birds::Finder] ' . ErrorCodeEnum::BIRDS__FINDER__DUCKS_DATABASE_EXCEPTION,
                [
                    "exception" => get_class($exception),
                    "message" => $exception->getMessage(),
                    "previous" => [
                        "exception" => $exception->getPrevious() ? get_class($exception->getPrevious()) : null,
                        "message" => $exception->getPrevious() ? $exception->getPrevious()
                            ->getMessage() : null,
                    ],
                    "trace" => $exception->getTrace(),
                    'data' => []
                ]
            );
        } catch (\Exception $exception) {
            $this->output = new ErrorOutput(
                new StatusOutput(ResponseEnum::INTERNAL_SERVER_ERROR, 'Internal Server Error'),
                ErrorCodeEnum::BIRDS__FINDER__GENERIC_EXCEPTION,
                'BIRDS::FINDER::GENERIC_EXCEPTION'
            );
            $this->logger->error(
                '[Birds::Finder] ' . ErrorCodeEnum::BIRDS__FINDER__DUCKS_DATABASE_EXCEPTION,
                [
                    "exception" => get_class($exception),
                    "message" => $exception->getMessage(),
                    "previous" => [
                        "exception" => $exception->getPrevious() ? get_class($exception->getPrevious()) : null,
                        "message" => $exception->getPrevious() ? $exception->getPrevious()
                            ->getMessage() : null,
                    ],
                    "trace" => $exception->getTrace(),
                ]
            );
        }
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }
}
