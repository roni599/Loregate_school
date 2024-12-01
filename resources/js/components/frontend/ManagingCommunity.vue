<template>
    <div class="container teacher-gallery py-5">
        <div class="academydiv m-auto mb-4">
            Managing Community
        </div>
        <div class="teacher_details bg-light p-3 mb-3">
            <div class="row text-center align-items-center">
                <div v-for="item in managingcummunityList" :key="item.id" class="col-md-3">
                    <img :src="`/backend/images/managingcummunity/${item.image}`" class="mb-2" width="100" height="100"
                        alt="" srcset="">
                    <p class="no-margin">{{ item.name }}</p>
                    <p class="no-margin">{{ item.designation }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    name: "Teacher Gallery",
    setup() {
        const managingcummunityList = ref([]);
        const managingcummunityListData = async () => {
            try {
                const response = await axios.get(`/api/academy/managingcummunityindex`);
                if (response.data.data) {
                    managingcummunityList.value = response.data.data
                }
            } catch (error) {

            }
        }
        onMounted(() => {
            managingcummunityListData();
        })
        return {
            managingcummunityList,
            managingcummunityListData
        }
    }
}
</script>

<style scoped>
.academydiv {
    width: 300px;
    background-color: red;
    text-align: center;
    padding: 10px 0px;
    color: white;
    font-weight: bold;
}

.no-margin {
    margin: 0;
}
</style>