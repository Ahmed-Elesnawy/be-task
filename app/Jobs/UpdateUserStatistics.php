<?php

namespace App\Jobs;

use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateUserStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const PLUS_BY = 1;

    public int $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statistic = Statistic::whereUserId($this->userId)->first();

        if ($statistic) {
            $statistic->increment('task_count', self::PLUS_BY);
        } else {
            Statistic::create([
                'user_id' => $this->userId,
                'task_count' => self::PLUS_BY
            ]);
        }
    }
}
