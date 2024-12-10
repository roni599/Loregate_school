<?php

namespace App\Http\Controllers;

use App\Helpers\ImageValidator;
use App\Helpers\ResponseHelper;
use App\Models\Admission;
use App\Models\ClassInformation;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        $student=Student::with(['admission','admissionassign'])->get();
        return ResponseHelper::success($student,"Student data retrive successfully");
    }

    public function store(Request $request)
    {
        // return response()->json($request->all());
        $uuid = rand(100000, 999999);
        $admission = auth('admissions')->user();
        if (!$admission) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        if ($request->has('Picture') && $request->Picture) {
            $image = $request->Picture;
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/StudentsInformation/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }

            $imagePath = $saveImage['image_name'];
        }

        if ($request->has('signature') && $request->signature) {
            $image = $request->Picture;
            $saveImage = ImageValidator::saveBase64Image($image, 'backend/images/StudentsInformation/');

            if (!$saveImage['status']) {
                return response()->json(['message' => $saveImage['message']], 422);
            }

            $imagePath2 = $saveImage['image_name'];
        }

        $educationData = [];
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'row')) {
                $educationData[] = $value;
            }
        }
        $data = [
            'st_name' => $request->fieldValues1,
            'st_gender' => $request->fieldValues2,
            'st_religion' => $request->fieldValues3,
            'st_age' => $request->fieldValues4,
            'st_dob' => $request->fieldValues5,
            'st_birth_certificate_no' => $request->fieldValues6,
            'st_nid_no' => $request->fieldValues7,
            'st_passport_no' => $request->fieldValues8,
            'st_nationality' => $request->fieldValues9,
            'st_email' => $request->fieldValues10,
            'st_mobile' => $request->fieldValues11,
            'st_pre_division' => $request->fieldValues12,
            'st_pre_district' => $request->fieldValues13,
            'st_pre_sub_district' => $request->fieldValues14,
            'st_pre_address_details' => $request->fieldValues15,
            'st_per_division' => $request->fieldValues16,
            'st_per_district' => $request->fieldValues17,
            'st_per_sub_district' => $request->fieldValues18,
            'st_per_address_details' => $request->fieldValues19,
            'st_father_name' => $request->fieldValues20,
            'st_father_nid_no' => $request->fieldValues21,
            'st_father_passport_no' => $request->fieldValues22,
            'st_father_nationality' => $request->fieldValues23,
            'st_father_email' => $request->fieldValues24,
            'st_father_mobile' => $request->fieldValues25,
            'st_mother_name' => $request->fieldValues26,
            'st_mother_nid_no' => $request->fieldValues27,
            'st_mother_passport_no' => $request->fieldValues28,
            'st_mother_nationality' => $request->fieldValues29,
            'st_mother_email' => $request->fieldValues30,
            'st_mother_mobile' => $request->fieldValues31,
            'st_guardian_name' => $request->fieldValues32,
            'st_guardian_nid_no' => $request->fieldValues33,
            'st_guardian_passport_no' => $request->fieldValues34,
            'st_guardian_nationality' => $request->fieldValues35,
            'st_guardian_email' => $request->fieldValues36,
            'st_guardian_mobile' => $request->fieldValues37,
            'st_guardian_relation' => $request->fieldValues38,
            'st_guardian_address' => $request->fieldValues39,
            'st_guardian_contact_person' => $request->fieldValues42,
            'st_picture' => $imagePath,
            'st_signature' => $imagePath2,
            'education' => json_encode($educationData),
            'admission_id' => $admission->id,
            'student_id' => $uuid,
            'admission_assign_id'=>$request->class_id
        ];
        
        $student = Student::create($data);

        return response()->json([
            'message' => 'Student record created successfully!',
            'student' => $student,
        ], 201);
    }

    public function studentadmissionfind()
    {
        $admission = auth('admissions')->user();
        if (!$admission) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $studentAdmission = Student::where('admission_id', $admission->id)
            ->with('admission.admissionAssign')
            ->first();
        return ResponseHelper::success($studentAdmission, 'Student data retrive successfully');
    }

    public function finddata($id){
        $studentAdmission = Student::with(['admission','admissionassign'])->find($id);
        return ResponseHelper::success($studentAdmission, 'Student data retrive successfully');
    }
    public function studentadmissionClassInformationfinddata($id){
        $student=Student::findOrFail($id);
        $admissionClassInformation=ClassInformation::where('assign_class_id',$student->admission_assign_id)->first();
        return ResponseHelper::success($admissionClassInformation,'Admission Class Information data retrive successfully');
    }
    public function studentadmissionClassInformationfind(){
        $admission = auth('admissions')->user();
        if (!$admission) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $studentAdmission = Student::where('admission_id', $admission->id)->first();
        $admissionClassInformation=ClassInformation::where('assign_class_id',$studentAdmission->id)->first();
        return ResponseHelper::success($admissionClassInformation,"Admission Class Information data retrive successfully");
    }
}
