import { useState } from "react";


export function TaskForm(addTask) {
    
    const [input, setInput] = useState("");

    function handleSubmit(event){
        event.preventDefault();
        if(!input.trim()) return;
        addTask(input);
        setInput("");
    }

    return (
        <form className="form" onSubmit={handleSubmit}>
            <input 
                type="text"
                placeholder="Nueva tarea..."
                value={input}
                onChange={(event) => setInput(event.target.value)}
             />
             <button type="submit">Añadir tarea</button>
        </form>
    );
}