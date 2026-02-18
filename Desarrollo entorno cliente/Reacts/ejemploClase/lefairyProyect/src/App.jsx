import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import { Header } from './Header.jsx'
import { SepecialButton } from './SpecialButton.jsx'


function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <Header />
      <SepecialButton text="Boton 1" />
      <SepecialButton text="Boton 2" />
      
    </>
  )
}

export default App
