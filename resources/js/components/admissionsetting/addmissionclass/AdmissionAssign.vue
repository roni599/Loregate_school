<template>
  <div class="container-fluid">
    <div class="card mt-4 mb-3">
      <div class="card-header border-bottom-0 p-4">
        <router-link class="text-decoration-none text-info h5" to="/admin-dashboard">Dashboard</router-link>
        <span class="text-muted h5"> / Admission-assign</span>
      </div>
    </div>
    <div class="row mb-3">
      <div class="buttonalign d-flex justify-content-md-start justify-content-center gap-2">
        <div>
          <button @click="componentLoad" class="btn btn-info px-5">Assign List</button>
        </div>
        <div>
          <button @click="anotherLoad" class="btn btn-info px-5">Admission Assign create</button>
        </div>
      </div>
    </div>
    <div v-show="!currentComponent" class="row">
      <div class="col-lg-12">
        <div class="card rounded-lg mt-1">
          <div class="card-header d-flex justify-content-between align-items-center">
            <div class="icon_text d-flex gap-2 mt-3">
              <p> <i class="fa-solid fa-chart-line"></i></p>
              <p class="text-black font-bold">Admission Assign Create</p>
            </div>
          </div>
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="className" class="form-label mb-0">Class Name</label>
                    <select class="form-select" v-model="form.class_name">
                      <option selected>Open this select menu</option>
                      <option v-for="classItem in classes" :key="classItem.id" :value="classItem.class_name">
                        {{ classItem.class_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="classDetails" class="form-label mb-0">Class Details</label>
                    <select class="form-select" v-model="form.class_details">
                      <option selected>Open this select menu</option>
                      <option v-for="classItem in classes" :key="classItem.id"
                        :value="`${classItem.shift}>${classItem.section}>${classItem.group}>${classItem.session}`">
                        {{ classItem.shift }} <span v-if="classItem.shift != null">></span>{{ classItem.section }}
                        <span v-if="classItem.section != null">></span>{{ classItem.group }}<span
                          v-if="classItem.group != null">></span>{{ classItem.session }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="startDate" class="form-label mb-0">Start Date</label>
                    <input type="date" class="form-control" v-model="form.start_date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="startTime" class="form-label mb-0">Start Time</label>
                    <input type="time" class="form-control" v-model="form.start_time">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="endDate" class="form-label mb-0">End Date</label>
                    <input type="date" class="form-control" v-model="form.end_date">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="endTime" class="form-label mb-0">End Time</label>
                    <input type="time" class="form-control" v-model="form.end_time">
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="qty" class="form-label mb-0">Set Qty</label>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" v-model="showFields.setQty" />
                  <label class="form-check-label">Enable Qty</label>
                </div>
                <input type="number" class="form-control" v-if="showFields.setQty" v-model="form.qty"
                  placeholder="Enter Qty" />
              </div>

              <div class="mb-3">
                <label for="maleQty" class="form-label mb-0">Set Male Qty</label>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" v-model="showFields.setMaleQty" />
                  <label class="form-check-label">Enable Male Qty</label>
                </div>
                <input type="number" class="form-control" v-if="showFields.setMaleQty" v-model="form.male_qty"
                  placeholder="Enter Male Qty" />
              </div>

              <div class="mb-3">
                <label for="femaleQty" class="form-label mb-0">Set Female Qty</label>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" v-model="showFields.setFemaleQty" />
                  <label class="form-check-label">Enable Female Qty</label>
                </div>
                <input type="number" class="form-control" v-if="showFields.setFemaleQty" v-model="form.female_qty"
                  placeholder="Enter Female Qty" />
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="fee" class="form-label mb-0">Fee</label>
                    <input type="text" class="form-control" v-model="form.fee" placeholder="Enter Fee">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="paymentType" class="form-label mb-0">Payment Type</label>
                    <input type="text" class="form-control" v-model="form.payment_type"
                      placeholder="Enter Payment Type">
                  </div>
                </div>
              </div>

              <div class="mb-0">
                <div class="d-grid">
                  <button class="btn btn-info w-100 mb-2" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"
                      aria-hidden="true"></span>
                    <span v-if="!loading">Admission Assign</span>
                    <span v-if="loading">Admission Assign...</span>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <component :is="currentComponent"></component>
</template>

<script>
import { ref, reactive, shallowRef, markRaw, onMounted, watch } from 'vue';
import AdmissionassignList from './AdmissionassignList.vue';
import axios from 'axios';

export default {
  name: "AdmissionAssign",
  setup() {
    const form = ref({
      class_name: '',
      class_details: '',
      start_date: '',
      start_time: '',
      end_date: '',
      end_time: '',
      qty: null,
      male_qty: null,
      female_qty: null,
      fee: '',
      payment_type: '',
    });

    const showFields = reactive({
      setQty: false,
      setMaleQty: false,
      setFemaleQty: false,
    });

    const classes = ref([]);
    const currentComponent = shallowRef(null);
    const loading = ref(false);

    const componentLoad = () => {
      currentComponent.value = markRaw(AdmissionassignList);
    };

    const anotherLoad = () => {
      currentComponent.value = null;
    };

    const fetchData = async () => {
      try {
        const response = await axios.get(`/api/classes`);
        if (response.data && response.data.message) {
          classes.value = response.data.data;
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    const submitForm = async () => {
      loading.value = true;
      try {
        const response = await axios.post('/api/admissionassign/store', form.value);
        if (response.data && response.data.message) {
          resetForm();
          Swal.fire({
            icon: "success",
            title: response.data.message,
          });
        }
      } catch (error) {
        console.error(error);
      } finally {
        loading.value = false;
      }
    };
    watch(
      () => [showFields.setQty, showFields.setMaleQty, showFields.setFemaleQty],
      ([newSetQty, newSetMaleQty, newSetFemaleQty]) => {
        if (!newSetQty) form.value.qty = null;
        if (!newSetMaleQty) form.value.male_qty = null;
        if (!newSetFemaleQty) form.value.female_qty = null;
      }
    );

    const resetForm = () => {
      form.value = {
        class_name: '',
        class_details: '',
        start_date: '',
        start_time: '',
        end_date: '',
        end_time: '',
        qty: null,
        male_qty: null,
        female_qty: null,
        fee: '',
        payment_type: '',
      };

      // Reset checkbox-related fields
      showFields.setQty = false;
      showFields.setMaleQty = false;
      showFields.setFemaleQty = false;
    };

    onMounted(fetchData);

    return {
      form,
      showFields,
      classes,
      componentLoad,
      currentComponent,
      loading,
      submitForm,
      anotherLoad,
      resetForm
    };
  },
};
</script>
