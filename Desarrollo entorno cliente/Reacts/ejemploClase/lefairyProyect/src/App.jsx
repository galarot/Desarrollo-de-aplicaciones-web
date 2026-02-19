import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import { Header } from './components/Header.jsx'
import {TaskForm} from './components/TaskForm.jsx'
import {TaskList} from './components/TaskList.jsx'



function App() {

  return (
    <>
      <Header />
      <TaskForm></TaskForm>
      <TaskList></TaskList>
      
    </>
  )
}

export default App
