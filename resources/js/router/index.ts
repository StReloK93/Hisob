import { createRouter, createWebHistory } from "vue-router"
import routes from "./routes"
import { auth } from '@/store/auth'

// @ts-ignore
const router = createRouter({ history: createWebHistory(), routes})

router.beforeEach((to, from, next) => {
	const store = auth()
	if (store.user) {
		if (to.meta.guard === 'guest') next({ name: 'main' })
		else next()

	} else {
		if (to.meta.guard === 'auth') next({ name: 'login' })
		else next()
	}
})

export default router