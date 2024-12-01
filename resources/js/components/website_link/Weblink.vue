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
                                    <th scope="col">Link Title</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(websitelink ,index) in websitelinkDataList" :key="websitelink.id">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ websitelink.title }}</td>
                                    <td>{{ websitelink.link }}</td>
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
    name:"Weblink-vue",
    setup(){
        const currentComponent = ref(false);
        const academy_id=ref(1);
        const websitelinkDataList=ref([]);
        const fetchWeblink=async()=>{
            try {
                const response=await axios.get(`/api/academy/websitelink/${academy_id.value}`)
                if(response.data){
                    websitelinkDataList.value=response.data.data
                }
            } catch (error) {
                
            }
        }
        onMounted(()=>{
            fetchWeblink()
        })
        return{
            currentComponent,
            fetchWeblink,
            academy_id,
            websitelinkDataList
        }
    }
}
</script>

<style>

</style>