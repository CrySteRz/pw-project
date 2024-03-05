<?php

declare(strict_types=1);

namespace App\Service\Discipline;

use App\Entity\Discipline;
use App\Exception\Discipline as DisciplineException;
use App\Repository\DisciplineRepository;

final class DisciplineService extends Base
{
    public function __construct(
        protected DisciplineRepository $disciplineRepository
    ) {
    }

    protected function getDisciplineRepository(): DisciplineRepository
    {
        return $this->disciplineRepository;
    }
 
    /**
     * @return array<string>
     */
    public function getAll(): array
    {
        return $this->getDisciplineRepository()->getAllDisciplines();
    }

    public function getOne(int $disciplineId): object
    {
        $Discipline = $this->getDisciplineFromDb($DisciplineId, $userId)->toJson();
        return $Discipline;
    }

    /**
     * @param array<string> $input
     */
    public function create(array $input): object
    {
        // $data = json_decode((string) json_encode($input), false);
        // if (! isset($data->name)) {
        //     throw new \App\Exception\Discipline('The field "name" is required.', 400);
        // }
        // $myDiscipline = $this->createDiscipline($data);
        // /** @var Discipline $Discipline */
        // $Discipline = $this->getDisciplineRepository()->create($myDiscipline);
        // return $Discipline->toJson();
    }

    public function createDiscipline(object $data): Discipline
    {
        // $Discipline = new Discipline();
        // $Discipline->updateName(self::validateDisciplineName($data->name));
        // $description = $data->description ?? null;
        // $Discipline->updateDescription($description);
        // $status = 0;
        // if (isset($data->status)) {
        //     $status = self::validateDisciplineStatus($data->status);
        // }
        // $Discipline->updateStatus($status);
        // $userId = null;
        // if (isset($data->decoded) && isset($data->decoded->sub)) {
        //     $userId = (int) $data->decoded->sub;
        // }
        // $Discipline->updateUserId($userId);

        // return $Discipline;
    }

    /**
     * @param array<string> $input
     */
    public function update(array $input, int $DisciplineId): object
    {
        // $data = $this->validateDiscipline($input, $DisciplineId);
        // /** @var Discipline $Discipline */
        // $Discipline = $this->getDisciplineRepository()->update($data);
        // return $Discipline->toJson();
    }

    public function delete(int $DisciplineId, int $userId): void
    {
        // $this->getDisciplineFromDb($DisciplineId, $userId);
        // $this->getDisciplineRepository()->delete($DisciplineId, $userId);
    }

    private function validateDiscipline(array $input, int $DisciplineId): Discipline
    {
        // $Discipline = $this->getDisciplineFromDb($DisciplineId, (int) $input['decoded']->sub);
        // $data = json_decode((string) json_encode($input), false);
        // if (! isset($data->name) && ! isset($data->status)) {
        //     throw new DisciplineException('Enter the data to update the Discipline.', 400);
        // }
        // if (isset($data->name)) {
        //     $Discipline->updateName(self::validateDisciplineName($data->name));
        // }
        // if (isset($data->description)) {
        //     $Discipline->updateDescription($data->description);
        // }
        // if (isset($data->status)) {
        //     $Discipline->updateStatus(self::validateDisciplineStatus($data->status));
        // }
        // $userId = null;
        // if (isset($data->decoded) && isset($data->decoded->sub)) {
        //     $userId = (int) $data->decoded->sub;
        // }
        // $Discipline->updateUserId($userId);

        // return $Discipline;
    }
}