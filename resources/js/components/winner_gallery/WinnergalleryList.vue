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
                                    <th scope="col">#</th>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Winner Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Roll or UID</th>
                                    <th scope="col">Winning Place</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(event, index) in winneergalleryData" :key="event.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ event.event_name }}</td>
                                    <td>{{ event.name }}</td>
                                    <td>{{ event.class }}</td>
                                    <td>{{ event.roll_or_uid }}</td>
                                    <td>{{ event.winning_place }}</td>
                                    <td>{{ event.price }}</td>
                                    <td>
                                        <img v-if="event.image" :src="'/backend/images/winnergallery/' + event.image"
                                            alt="Event Image" width="50" height="50" />
                                    </td>
                                    <td>{{ formatDate(event.created_at) }}</td>
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
    name: "WinnergalleryList",
    setup() {
        
        const currentComponent = ref(false);
        const winneergalleryData = ref([]);

        const fetchWinnergalleryData = async () => {
            try {
                const response = await axios.get('/api/academy/winneergallery');
                if (response.data) {
                    winneergalleryData.value = response.data.data;
                }
            } catch (error) {
                console.log(error)
            }

        }

        const formatDate = (dateString) => {
            return moment(dateString).format('DD/MM/YYYY');
        };

        onMounted(() => {
            fetchWinnergalleryData();
        })
        return {
            currentComponent,
            fetchWinnergalleryData,
            winneergalleryData,
            formatDate
        }
    }
}
</script>

<style></style>