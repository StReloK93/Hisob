
import { defineStore } from "pinia"
import { ref , computed } from "vue"
import router from "@/router"
import axios from '@/modules/axios'

export const useAuthStore = defineStore('Auth', () => {
    const user = ref(null)

    async function login(data) {
        const result = await axios.post('login', data)
        if (result.status == 299) return result.data
        else {
            localStorage.setItem('token', `${result.data.type} ${result.data.token}`) // local
            await getUser()
            router.push({ name: 'main'})
        }
    }

    const userRoles = computed(() => {
        return user.value?.roles?.map((role) => role.role_id)
    })
    

    async function getUser() {

        axios.defaults.headers.common['Authorization'] = localStorage.getItem('token')
        await axios.get('user').then(({ data }) => {
            user.value = data
        }).catch(() => { console.clear() })

    }


    async function register(props) {
        try{
            const result = await axios.post('register', props)
            if (result.status == 200) login(props)
            else return result.data
        } catch (err){
            return err.response.data
        }
    }

    async function logout() {
        const data = await axios.get('logout')

        if (data.status == 200) {
            axios.defaults.headers.common['Authorization'] = null
            localStorage.removeItem('token')
            user.value = null
            router.push({ name: 'login' })
        }
    }

    return { user, userRoles,  getUser, login, register, logout }
})