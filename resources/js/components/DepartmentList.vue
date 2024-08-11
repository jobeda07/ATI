<template>
    <div>
        <h1>Departments</h1>
        <button @click="showForm">Add Department</button>
        <ul>
            <li v-for="department in departments" :key="department.id">
                {{ department.name }}
                <button @click="editDepartment(department)">Edit</button>
                <button @click="deleteDepartment(department.id)">Delete</button>
            </li>
        </ul>
        <department-form v-if="showFormFlag" @close="closeForm" :department="currentDepartment" />
    </div>
</template>

<script>
import axios from 'axios';
import DepartmentForm from './DepartmentForm.vue';

export default {
    components: { DepartmentForm },
    data() {
        return {
            departments: [],
            showFormFlag: false,
            currentDepartment: null,
        };
    },
    methods: {
        async fetchDepartments() {
            const response = await axios.get('/api/departments');
            this.departments = response.data;
        },
        showForm() {
            this.currentDepartment = null;
            this.showFormFlag = true;
        },
        editDepartment(department) {
            this.currentDepartment = department;
            this.showFormFlag = true;
        },
        async deleteDepartment(id) {
            await axios.delete(`/api/departments/${id}`);
            this.fetchDepartments();
        },
        closeForm() {
            this.showFormFlag = false;
            this.fetchDepartments();
        },
    },
    mounted() {
        this.fetchDepartments();
    },
};
</script>
