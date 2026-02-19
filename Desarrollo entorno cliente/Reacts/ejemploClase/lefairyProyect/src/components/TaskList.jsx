import { Task } from "./Task";

export function TaskList({taskArray, deleteTask}){
    return (
        <ul className="task-list">
            {
                taskArray.map(task => (
                    <Task
                        key={task.id}
                        task={task}
                        deleteTask={deleteTask}
                    />
                ))
            }
        </ul>
    )
}
