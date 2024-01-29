<?php

namespace Database\Seeders\Production;


use App\Models\JobTitle;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Seeder;
use Orchid\Attachment\File;
use App\Models\Employee;
use App\Models\Branch;
use Carbon\Carbon;
use Orchid\Attachment\Models\Attachment;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = \Storage::json('departments.json');
        $data = $file['data'];

        foreach (Branch::all() as $old_branch) {
            $old_branch->delete();
        }

        foreach (Employee::all() as $old_employee) {
            $old_employee->delete();
        }

        foreach (JobTitle::all() as $old_job_titles) {
            $old_job_titles->delete();
        }

        foreach ($data as $key => $branch) {
            $current_branch = Branch::create([
                'id'        => $key + 1,
                'title'     => $branch['department'],
                'address'   => $branch['adress'],
                'phone'     => '88002504043',
                'email'     => 'info@jurcorpus.com',
                'latitude'  => null,
                'longitude' => null,
                'created_at'=> Carbon::now(),
            ]);

            echo "\n" . $branch['department'] . "\n";

            foreach ($branch['team'] as $employee) {

                $fio = explode(' ', $employee['fio']);

                echo "\t" . $employee['fio'] . "\n";

                $current_employee = Employee::create([
                    'last_name'     => $fio[0] ?? '',
                    'first_name'    => $fio[1] ?? '',
                    'sur_name'      => $fio[2] ?? '',
                    'email'         => 'employee@jurcorpus.ru',
                    'phone'         => '88002504043',
                    'branch_id'     => $current_branch->id,
                    'description'   => strip_tags($employee['description']) ?? '',
                ]);

                if (!empty($employee['jobtitle'])) {
                    $jobtitles = explode(', ', $employee['jobtitle']);

                    $jt_array = [];

                    foreach ($jobtitles as $jobtitle) {

                        $jt = JobTitle::where('title',$jobtitle)->get()[0] ?? [];

                        if (empty($jt)){
                            $jt = JobTitle::create([
                                'title' => $jobtitle,
                            ]);
                        }

                        $jt_array[] = $jt->id;
                    }

                    $current_employee->job_titles()->sync($jt_array);

                }

                if (!empty($employee['avatar'])) {
                    $file = new UploadedFile(__DIR__ . '/../../../storage/app/public/old_employees' . $employee['avatar'], $employee['avatar']);
                    $avatar = (new File($file))->load();
                    $current_employee->attachment()->sync($avatar);
                }
            }
        }
    }
}
