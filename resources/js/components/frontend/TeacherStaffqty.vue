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
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "TeacherStaffqty",
    setup() {
        const teacherStaffqty = ref({})
        const teacherStaffqtyData = async () => {
            const response = await axios.get(`/api/academy/staff-data`)
            if (response.data.data) {
                teacherStaffqty.value = response.data.data
            }
        }

        onMounted(() => {
            teacherStaffqtyData();
        })

        return {
            teacherStaffqty,
        };
    },
};
</script>

<style></style>