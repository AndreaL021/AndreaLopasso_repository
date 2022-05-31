<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
                <Link v-if="activeUserCompany===0" :href="route('users.create')" class="float-right">
                    <jet-button>Create</jet-button>
                </Link>
                <Link :href="route('users.edit', $page.props.user.id)" class="float-right">
                    <jet-button>Edit</jet-button>
                </Link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-4 lg:px-8">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-50">
                            <tr>
                              <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                              <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Azienda</th>
                              <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruolo</th>
                              <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users" :key="user.id">
                              <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                  <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">{{user.name}}</div>
                                    <div class="text-sm text-gray-500">{{user.email}}</div>
                                  </div>
                                </div>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                <div v-for="company in companies" :key="company.user_id" class="flex items-center">
                                  <div v-if="company.user_id===user.id" class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">{{company.business_name}}</div>
                                    <div class="text-sm text-gray-500">{{company.business_email}}</div>
                                  </div>
                                </div>
                              </td>
                              <td class="pl-8 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">gfdgd</div>
                              </td>
                              <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link :href="route('users.show', user.id)" class="px-4 text-indigo-600 hover:text-indigo-900">
                                  Show
                                </Link>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import JetButton from '@/Jetstream/Button';
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            Link,
        },
        props: ['users', 'companies', 'activeUserCompany'],
    })
</script>
