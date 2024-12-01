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
                                    <th scope="col">Subject</th>
                                    <th scope="col">Heading</th>
                                    <th scope="col">Writer</th>
                                    <th scope="col">Data Source</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(magazine, index) in magazineData" :key="magazine.id">
                                    <th>{{ index + 1 }}</th>
                                    <td>{{ magazine.subject }}</td>
                                    <td>{{ magazine.heading }}</td>
                                    <td>{{ magazine.writer }}</td>
                                    <td>{{ magazine.data_sources }}</td>
                                    <td>{{ magazine.description }}</td>
                                    <td>{{ magazine.date }}</td>
                                    <td><img :src="`/backend/images/magazine/${magazine.image}`" :alt="magazine.name"
                                            width="50" height="50" /></td>
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

export default {
    name: "MagazineList",
    setup() {
        const magazineData = ref([]);
        const fetchMagazineData = async () => {
            try {
                const response = await axios.get('/api/academy/magazine');
                if (response.data) {
                    magazineData.value = response.data.data
                }
            } catch (error) {
                console.log(error)
            }

        };

        const currentComponent = ref(false);

        onMounted(() => {
            fetchMagazineData();
        });

        return {
            fetchMagazineData,
            magazineData,
            currentComponent
        };
    }
};
</script>

<style></style>