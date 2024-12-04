<template>
    <div class="container-fluid">
        <table class="table table-striped table-hover table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Class</th>
                    <th>Details</th>
                    <th>Start Date</th>
                    <th>Time</th>
                    <th>End Date</th>
                    <th>Time</th>
                    <th>Set Qty</th>
                    <th>Male</th>
                    <th>Female</th>
                    <th>Fee</th>
                    <th>Payment Type</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(admission, index) in admissionAssigns" :key="admission.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ admission.class_name }}</td>
                    <td>{{ admission.class_details }}</td>
                    <td>{{ formatDate(admission.start_date) }}</td>
                    <td>{{ formatTime(admission.start_time) }}</td>
                    <td>{{ formatDate(admission.end_date) }}</td>
                    <td>{{ formatTime(admission.end_time) }}</td>
                    <td>{{ admission.qty || 0 }}</td>
                    <td>{{ admission.male_qty || 0 }}</td>
                    <td>{{ admission.female_qty || 0 }}</td>
                    <td>{{ admission.fee }}</td>
                    <td>{{ admission.payment_type }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
export default {
    name: "AdmissionassignList",
    setup() {
        const currentComponent = ref(false);
        const admissionAssigns = ref([]);
        const fetchData = async () => {
            try {
                const response = await axios.get(`/api/admissionassign`);
                if (response.data && response.data.message) {
                    admissionAssigns.value = response.data.data;
                    console.log(admissionAssigns.value)
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        const formatTime = (time) => {
            const date = new Date(`1970-01-01T${time}Z`);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
        };
        const formatDate = (date) => {
            const dateObj = new Date(date); // Convert string to Date object
            const day = String(dateObj.getDate()).padStart(2, '0');
            const month = String(dateObj.getMonth() + 1).padStart(2, '0'); // months are zero-based
            const year = dateObj.getFullYear();

            return `${day}-${month}-${year}`;
        };
        onMounted(() => {
            fetchData();
        })
        return {
            currentComponent,
            fetchData,
            admissionAssigns,
            formatTime,
            formatDate
        }
    }
}
</script>

<style></style>