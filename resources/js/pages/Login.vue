<template>
    <div>
        <div>
            <h1>Iniciar Sesion</h1>

            <div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" v-model="usuario" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="pass" v-model="password" id="password" class="input-text" placeholder="Password" />
                </div>

                <button class="btn-submit" @click="login" >Iniciar sesion</button>

            </div>

        </div>
        
    </div>
</template>

<script setup>

import {ref} from 'vue'
import axios from 'axios'

const usuario = ref('')
const password = ref('')


const login = async () => {
    try{
    
        const response = await axios.post('http://localhost:8000/api/aut/login',{
            email: usuario.value,
            password: password.value 
        })

        if(response.data.userData){
            router.push('/home')
        }else{
            alert('Usuario o password incorrectos')
        }

        

    } catch (error){
        console.log(error)
        alert('Ocurrio un error :(')
    }
}

</script>

<style>
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
}

label{
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.25rem;
}

.input-text{
    padding: 0.6rem 1rem;
    font-size: 1rem;
    border-radius: 0.5rem;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.input-text{
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
}

</style>