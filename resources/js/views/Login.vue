<template>
	<div>
		<v-dialog v-model="dialog" persistent max-width="600px" min-width="360px">
			<div>
				<v-tabs
					v-model="tab"
					show-arrows
					background-color="deep-purple accent-4"
					icons-and-text
					dark
					grow
				>
					<v-tabs-slider color="purple darken-4"></v-tabs-slider>
					<v-tab v-for="i in tabs" :key="i.name">
						<v-icon large>{{ i.icon }}</v-icon>
						<div class="caption py-1">{{ i.name }}</div>
					</v-tab>
					<v-tab-item>
						<v-card class="px-4">
							<v-card-text>
								<v-form ref="loginForm" v-model="valid" lazy-validation>
									<v-row>
										<v-col cols="12">
											<v-text-field
												v-model="loginEmail"
												label="E-mail"
												required
											></v-text-field>
										</v-col>
										<v-col cols="12">
											<v-text-field
												v-model="loginPassword"
												label="PassWord"
												:type="logingShowPassword ? 'text' : 'password'"
												:append-icon="
													logingShowPassword ? 'mdi-eye' : 'mdi-eye-off'
												"
												@click:append="logingShowPassword = !logingShowPassword"
											></v-text-field>
										</v-col>
										<v-col class="d-flex" cols="12" sm="6" xsm="12"> </v-col>
										<v-spacer></v-spacer>
										<v-col class="d-flex" cols="12" sm="3" xsm="12" align-end>
											<v-btn
												x-large
												block
												:disabled="!valid"
												color="success"
												@click="loging"
											>
												Login
											</v-btn>
										</v-col>
									</v-row>
								</v-form>
							</v-card-text>
						</v-card>
					</v-tab-item>
					<v-tab-item>
						<v-card class="px-4">
							<v-card-text>
								<v-form ref="registerForm" v-model="valid" lazy-validation>
									<v-row>
										<v-col cols="12" sm="6" md="6">
											<v-text-field v-model="firstName"></v-text-field>
										</v-col>
										<v-col cols="12" sm="6" md="6">
											<v-text-field v-model="lastName"></v-text-field>
										</v-col>
										<v-col cols="12">
											<v-text-field v-model="email"></v-text-field>
										</v-col>
										<v-col cols="12">
											<v-text-field
												v-model="password"
												label="Password"
											></v-text-field>
										</v-col>
										<v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
											<v-btn x-large block :disabled="!valid" color="success"
												>Register</v-btn
											>
										</v-col>
									</v-row>
								</v-form>
							</v-card-text>
						</v-card>
					</v-tab-item>
				</v-tabs>
			</div>
		</v-dialog>
	</div>
</template>

<script>
//ejemplo https://www.codeply.com/p/hBkZaWgmnk
import { mapActions } from 'vuex'

export default {
	name: 'login',
	computed: {},
	methods: Object.assign({}, mapActions(['loginToApi']), {
		loging() {
			this.loginToApi({ email: this.loginEmail, password: this.loginPassword })
		}
	}),
	data: () => ({
		dialog: true,
		tab: 0,
		tabs: [
			{ name: 'Login', icon: 'mdi-account' },
			{ name: 'Register', icon: 'mdi-account-outline' }
		],
		valid: true,
		firstName: '',
		lastName: '',
		email: '',
		password: '',
		verify: '',
		loginPassword: '',
		loginEmail: '',
		logingShowPassword: false
	})
}
</script>
