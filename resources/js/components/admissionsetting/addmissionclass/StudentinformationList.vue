<template>
    <div class="container-fluid">
        <div v-for="form in Formnames" :key="form.id" class="form-check">
            <input class="form-check-input" type="checkbox" :id="'flexCheck-' + form.id" v-model="form.status"
                @change="updateFormStatus(form.id, form.status)" :true-value="1" :false-value="0" />
            <label class="form-check-label" :for="'flexCheck-' + form.id">
                {{ form.name }}
            </label>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.L</th>
                        <th scope="col">Field Name</th>
                        <th scope="col">Field Type</th>
                        <th scope="col">Options</th>
                        <th scope="col">Required</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(field, index) in getFieldsByFormId(form.id)" :key="field.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ field.field_name }}</td>
                        <td>{{ field.field_type }}</td>
                        <td>
                            <span v-if="field.options && field.options.length">
                                {{ field.options.join(', ') }}
                            </span>
                            <span v-else>
                                N/A
                            </span>
                        </td>
                        <td>{{ field.required ? 'Required' : 'Not Required' }}</td>
                        <td>
                            <div>
                                <label>
                                    <input type="radio" :name="'status-' + field.id" value="1" v-model="field.status"
                                        @change="updateStatus(field.id, 1)" />
                                    Active
                                </label>
                                <label>
                                    <input type="radio" :name="'status-' + field.id" value="0" v-model="field.status"
                                        class="ms-4" @change="updateStatus(field.id, 0)" />
                                    Inactive
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: 'StudentinformationList',
    setup() {
        const Formnames = ref([]);
        const fields = ref([]);

        const fetchForm = async () => {
            try {
                const response = await axios.get('/api/form-names');
                if (response.data && response.data.message) {
                    Formnames.value = response.data.data;
                }
            } catch (error) {
                console.error('Error fetching form names:', error);
            }
        };

        const fetchData = async () => {
            try {
                const response = await axios.get('/api/fields');
                if (response.data && response.data.message) {
                    fields.value = response.data.data;
                }
            } catch (error) {
                console.error('Error fetching fields data:', error);
            }
        };

        const updateStatus = async (fieldId, status) => {
            try {
                const response = await axios.post(`/api/fields/update-status/${fieldId}`, {
                    status: status,
                });
                if (response.data && response.data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error('Error updating field status:', error);
            }
        };

        const getFieldsByFormId = (formId) => {
            return fields.value.filter((field) => field.form_name_id === formId);
        };

        const updateFormStatus = async (formId, status) => {
            try {
                const response = await axios.post(`/api/form-names/update-status/${formId}`, {
                    isChecked: status,
                });

                if (response.data && response.data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
            } catch (error) {
                console.error('Error updating form status:', error);
            }
        };

        onMounted(() => {
            fetchForm();
            fetchData();
        });

        return {
            Formnames,
            fields,
            updateStatus,
            getFieldsByFormId,
            updateFormStatus
        };
    },
};
</script>

<style scoped></style>