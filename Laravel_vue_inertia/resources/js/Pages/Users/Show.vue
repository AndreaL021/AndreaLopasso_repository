<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Show
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="company" class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5">
                    Nome: {{user.name}} <br>
                    Email: {{user.email}} <br>
                    Ragione Sociale: {{company.business_name}} <br>
                    Email aziendale: {{company.business_email}} <br>
                    Regione: {{company.region}} <br>
                    Provincia: {{company.province}} <br>
                    Città: {{company.city}} <br>
                    Indirizzo: {{company.address}} <br>
                    CAP: {{company.cap}} <br>
                    Account creato il: {{user.created_at}} <br>
                    Ultimo aggiornamento: {{user.updated_at}}
                </div>
                <div v-else class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-5">
                    Nome: {{user.name}} <br>
                    Email: {{user.email}} <br>
                    Account creato il: {{user.created_at}} <br>
                    Ultimo aggiornamento: {{user.updated_at}}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { defineComponent } from 'vue'

    export default defineComponent({
        components: {
            AppLayout,
        },
        props: ['user', 'company'],
    })
</script>
