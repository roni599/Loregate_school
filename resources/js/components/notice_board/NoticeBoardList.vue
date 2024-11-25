<template>
    <div class="container-fluid">
        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Notice-Board List / Table</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Signature</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in noticeBoardData" :key="item.id">
                                    <td>{{ index + 1 }}</td> <!-- Display row number -->
                                    <td>{{ item.date }}</td> <!-- Display the date -->
                                    <td>{{ item.reference }}</td> <!-- Display the reference -->
                                    <td>{{ item.subject }}</td> <!-- Display the subject -->
                                    <td>{{ item.description }}</td> <!-- Display the description -->
                                    <td><img v-if="item.signature" :src="'/backend/images/boardNotice/' + item.signature" alt="Signature"
                                            width="50" height="50" /></td> <!-- Display the signature -->
                                    <td>{{ formatDate(item.created_at) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import moment from "moment";
export default {
    name: "NoticeBoard",
    setup() {
        const currentComponent = ref(false);
        const noticeBoardData = ref([]);

        const fetchNoticeBoardData = async () => {
            try {
                const response = await axios.get('/api/academy/board-notice');
                if (response.data) {
                    noticeBoardData.value = response.data.data
                }
            } catch (error) {
                console.log(error)
            }

        }
        const formatDate = (dateString) => {
            return moment(dateString).format('DD/MM/YYYY'); // Format to dd/mm/yyyy
        };

        onMounted(() => {
            fetchNoticeBoardData()
        })
        return {
            currentComponent,
            fetchNoticeBoardData,
            noticeBoardData,
            formatDate
        }
    }
}
</script>

<style></style>