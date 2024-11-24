<template>
    <div class="container mb-5">
        <div class="winnergallery_list py-4 text-center">
            <h1 class="mb-4">Winner Gallery</h1>
            <img src="../../../../public/frontend/images/winner.png" alt="Winner Image" class="img-fluid mb-4"
                style="max-width: 200px; height: auto;">

            <div class="search_input d-flex justify-content-center align-items-center flex-wrap gap-3 ">
                <label for="event_name" class="d-block mb-1">Event Name</label>
                <input type="text" name="event_name" id="event_name" class="form-control"
                    style="max-width: 300px; width: 100%;" placeholder="Event Name">
                <input type="text" id="searchInput" class="form-control mt-2" style="max-width: 300px; width: 100%;"
                    placeholder="Search for ID..">
            </div>
        </div>
        <div class="victory mb-2 container w-100">
            <div class="row container w-100">
                <div v-for="item in winnergalleryList" :key="item.id" class="col-md-3 mb-3">
                    <div class="winner_image_sub d-flex justify-content-center gap-3">
                        <div class="winner_image">
                            <img :src="`/backend/images/winnergallery/${item.image}`" width="50px" height="50px" alt="">
                        </div>
                        <div class="subject_details">
                            <p class="no-space">{{ item.event_name }}</p>
                            <p class="no-space">{{ item.name }}</p>
                            <p class="no-space">Class: {{ item.class }}</p>
                            <p class="no-space">Roll/UID: {{ item.roll_or_uid }}</p>
                            <p class="no-space">Lavel:{{ item.winning_place }}</p>
                            <p class="no-space">Price: {{ item.price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "WinnergalleryAll",
    setup() {
        const winnergalleryList = ref([]);
        const winnergallerylistData = async () => {
            try {
                const response = await axios.get(`/api/academy/winneergallery`);
                if (response.data.data) {
                    winnergalleryList.value = response.data.data;
                }
            } catch (error) {

            }
        }
        onMounted(() => {
            winnergallerylistData();
        })
        return {
            winnergalleryList,
            winnergallerylistData
        }
    }
}
</script>

<style scoped>
#searchInput {
    background-image: url("/backend/assets/img/searchicon.png");
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 15%;
    font-size: 16px;
    padding: 8px 45px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
    margin-left: 5px;
}

#event_name {
    padding: 8px 20px;
    border: 1px solid #ddd;
    margin-left: 5px;
}
</style>