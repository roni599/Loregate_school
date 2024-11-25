<template>
    <div class="container-fluid">
        <div v-show="!currentComponent" class="row">
            <div class="col-lg-12">
                <div class="card rounded-lg mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="icon_text d-flex gap-2 mt-3">
                            <p> <i class="fa-solid fa-chart-line"></i></p>
                            <p class="text-black font-bold">Magazine List / Table</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Writer</th>
                                    <th scope="col">Data Sources</th>
                                    <th scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(boardnews, index) in boardnesDataList" :key="boardnews.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ boardnews.heading }}</td>
                                    <td>{{ formatDate(boardnews.created_at) }}</td>
                                    <td>{{ boardnews.writer }}</td>
                                    <td>{{ boardnews.data_sources }}</td>
                                    <td>{{ boardnews.description }}</td>
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
    name: "BoardnewsList",
    setup() {
        const currentComponent = ref(false);
        const boardnesDataList = ref([]);
        const academy_id = ref(1);

        const fetchBoardNewsData = async () => {
            try {
                const Response = await axios.get(`/api/academy/boardnewsindex`);
                if (Response.data) {
                    boardnesDataList.value = Response.data.data
                }
            } catch (error) {
               
            }
        }
        const formatDate = (dateString) => {
            return moment(dateString).format('DD/MM/YYYY');
        };

        onMounted(() => {
            fetchBoardNewsData()
        })
        return {
            currentComponent,
            boardnesDataList,
            academy_id,
            formatDate
        }
    }
}
</script>

<style></style>