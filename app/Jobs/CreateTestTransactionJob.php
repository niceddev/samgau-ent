<?php

namespace App\Jobs;

use App\Models\Test;
use App\Models\TestStudentAnswer;
use App\Models\TestSubject;
use App\Models\TestSubjectQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class CreateTestTransactionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        protected int   $userId,
        protected int   $score,
        protected int   $duration,
        protected array $subjectIds,
        protected array $userAnswers
    )
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        try {
            $test = Test::create([
                'local_uuid' => Str::uuid(),
                'student_id' => $this->userId,
                'score'      => $this->score,
                'duration'   => $this->duration,
            ]);

            foreach ($this->subjectIds as $subjectId) {
                $testSubject = TestSubject::create([
                    'test_id'    => $test->id,
                    'subject_id' => $subjectId,
                ]);

                if (!empty($this->userAnswers['subject-' . $subjectId])) {
                    foreach ($this->userAnswers['subject-' . $subjectId] as $question => $answers) {
                        $testSubjectQuestion = TestSubjectQuestion::create([
                            'test_id'          => $test->id,
                            'test_subjects_id' => $testSubject->id,
                            'subject_id'       => $subjectId,
                            'question_id'      => substr($question, 10),
                        ]);

                        TestStudentAnswer::create([
                            'test_id'                  => $test->id,
                            'test_subject_question_id' => $testSubjectQuestion->id,
                            'answers'                  => json_encode($answers),
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
        }

    }

}
