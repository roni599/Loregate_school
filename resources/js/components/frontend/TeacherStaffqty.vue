<template>
    <div class="teacher_student container d-flex justify-content-center align-items-center gap-5 mb-4">
        <div class="teacher d-flex justify-content-center align-items-center">
            <img src="../../../../public/frontend//images//meeting.png" width="40" height="40" alt="" />
            <div class="no-line-height mx-1">
                <p>Teacher/Staff</p>
                <p>{{ teacherStaffqty.teacher_staff_qty }}</p>
            </div>
        </div>
        <div class="graduante d-flex justify-content-center align-items-center">
            <img src="../../../../public/frontend/images/graduated.png" width="40" height="40" alt="" />
            <div class="no-line-height mx-1">
                <p>Student</p>
                <p>{{ teacherStaffqty.student_qty }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TeacherStaffqty",
    props:{
        teacherStaffqty:{
            type:Object,
            required:true
        }
    },
    setup() {
        return {
        };
    },
};
</script>

<style></style>