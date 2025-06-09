<template>
    <div>
        <div>
            <h1>Crear tarea</h1>
        </div>

        <div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" v-model="projectName" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <div class="form-group">
                    <label>Descripcion</label>
                    <input type="text" v-model="projectDecription" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <input type="text" v-model="projectStatus" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <button class="btn-submit" @click="createProject" >Crear proyecto</button>

        </div>

        <div>
            <div>
                <h1>Lista de proyectos</h1>
            </div>
            <div>
                <div v-for="project in listProjects">
                    <p>{{ project.name }}</p>
                    <p>{{ project.description }}</p>
                    <p>{{ project.status }}</p>
                    <button @click="deleteProject(project.id)">Borrar</button>
                    <button @click="updateProject(project)">Modificar</button>
                </div>
            </div>
        </div>

        <div>
            <div>
                <h1>Crear tarea</h1>

                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" v-model="taskProjectId" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" v-model="taskTitle" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" v-model="taskDueDate" id="usuario" class="input-text" placeholder="Usuario" />
                </div>

                <button class="btn-submit" @click="createTask" >Crear tarea</button>

            </div>
        </div>

        <div>
            <div>
                <h1>Lista de tareas</h1>
            </div>

            <div>
                <div v-for="task in listTasks"  :key="task.id">
                    <p>{{ task.title }}</p>
                    <p>{{ task.completed }}</p>
                    <p>{{ task.dueDate }}</p>
                    <button @click="deleteTask(task.id)">Borrar</button>
                    <button @click="completeTask(task.id)">Completar</button>
                    <button @click="updateTask(task)">Modificar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {onMounted, ref} from 'vue'
import axios from 'axios'

const listProjects = ref('')
const listTasks = ref('')

const projectName = ref('')
const projectDecription = ref('')
const projectStatus = ref(null)

const taskProjectId = ref('')
const taskTitle = ref('')
const taskDueDate = ref('')


const createProject = async () => {
    try{

        const response = await axios.post('http://localhost:8000/api/createProyecto',{
            name: projectName.value,
            description: projectDecription.value,
            status: projectStatus.value,
        })

        alert('Se creo el proyecto')

    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const updateProject = async (project) => {
    try{

        projectName.value = project.name
        projectDecription.value = project.description
        projectStatus.value = project.status

        const response = await axios.post('http://localhost:8000/api/updateProyecto',{
            name: projectName.value,
            description: projectDecription.value,
            status: projectStatus.value,
        })

        alert('Se actualizo el proyecto')

    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const deleteProject = async (id) => {
    try{
        const response = await axios.post('http://localhost:8000/api/deleteProyecto',{
            id: id,
           
        })

        alert('Se elimino el proyecto')

    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const createTask = async () => {
    try{
        const response = await axios.post('http://localhost:8000/api/createTarea',{
            projectId: taskProjectId.value,
            title: taskTitle.value,
            completed: false,
            dueDate: taskDueDate,
        })

        alert('Se creo la tarea')

    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const updateTask = async (task) => {
    try{
         
        taskProjectId = task.projectId
        taskTitle = task.title
        taskDueDate = task.dueDate

        const response = await axios.post('http://localhost:8000/api/updateTarea',{
            projectId: taskProjectId.value,
            title: taskTitle.value,
            completed: false,
            dueDate: taskDueDate,
        })

        alert('Se actualizo la tarea')

    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const deleteTask = async (id) => {
    try{
        const response = await axios.post('http://localhost:8000/api/deleteTarea',{
            id: id,
        })

        alert('Se borro la tarea')
    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}

const completeTask = async (id) => {
    try{
        const response = await axios.post('http://localhost:8000/api/completeTarea',{
            id: id,
            completed: true,
        })

        alert('Se completo la tarea')
    }catch(error){
        console.log(error)
        alert('Ocurrio un error')
    }
}


const getProyects = async () => {

    try{

        const response = await axios.get('http://localhost:8000/api/getProyectos')

        listProjects.value = await response.data.info

    } catch(error){
        console.log(error)
        alert('Ocurrio un erro al traer los proyectos')
    }
    
}

const getTasks = async () => {

    try{

        const response = await axios.get('http://localhost:8000/api/getTareas')

    listTasks.value = await response.data.info

    }catch(error){
        console.log(error)
        alert('Ocurrio un error al traer tareas')
    }
}

onMounted( () => {
    getProyects()
    getTasks()
})

</script>