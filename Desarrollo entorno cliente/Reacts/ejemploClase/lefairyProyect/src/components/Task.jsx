export function Task({task, deleteTask}){
    return (
        <li className="task">
            <span>{task.text}</span>
            <button className="delete-btn"
                onClick={() => deleteTask(task.id)}
            >
                X
            </button>
        </li>
    );
}
