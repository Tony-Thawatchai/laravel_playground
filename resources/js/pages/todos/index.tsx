import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { router } from '@inertiajs/react';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: '/todos',
    },
];

interface Todo {
    //  'title',
    // 'description',
    // 'due_date',
    // 'user_id',
    // 'is_complete',
    id: number;
    title: string;
    description: string;
    due_date: string;
    user: User; // Add the user object
    is_complete: boolean;
}

interface User {
    id: number;
    name: string;
    email: string;
}


function handleToggleComplete(id: number, isComplete: boolean) {
    router.put(`/todos/${id}/toggle-complete`, { is_complete: isComplete });
}

export default function TodosIndex({ todos }: { todos: Todo[] }) {
    console.log(todos);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Todos" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    {todos.data.map((todo) => (
                        <div
                            key={todo.id}
                            className="border-sidebar-border/70 dark:border-sidebar-border relative aspect-video overflow-hidden rounded-xl border p-4"
                        >
                            <h3 className="text-lg font-bold">{todo.title}</h3>
                            <p className="text-sm text-gray-600">{todo.id}</p>
                            <p className="text-sm text-gray-600">{todo.description}</p>
                            <span className="text-xs text-gray-400">Created at: {new Date(todo.created_at).toLocaleString()}</span>
                            <span className="text-xs text-gray-400">Due date: {new Date(todo.due_date).toLocaleString()}</span>
                            
                            <p className={`text-xs font-semibold ${todo.is_complete ? 'text-green-500' : 'text-red-500'}`}>
                                {' '}
                                {todo.is_complete ? 'Completed' : 'Not Completed'}
                            </p>
                            <div className="mt-2">
                                <label className="flex items-center gap-2">
                                    <input
                                        type="checkbox"
                                        checked={todo.is_complete}
                                        onChange={() => handleToggleComplete(todo.id, !todo.is_complete)}
                                        className="form-checkbox h-4 w-4 text-blue-600"
                                    />
                                    <span className="text-sm">Mark as {todo.is_complete ? 'Incomplete' : 'Complete'}</span>
                                </label>
                            </div>
                            
                            <span className="text-xs text-gray-400">Assigned to: {todo.user.name}</span>
                            <span className="text-xs text-gray-400">Email: {todo.user.email}</span>
                        </div>
                    ))}
                </div>
                {/* Pagination Links */}
                <div className="mt-4">
                    {todos.links.map((link: any, index: number) => (
                        <a
                            key={index}
                            href={link.url}
                            className={`rounded border px-4 py-2 ${link.active ? 'bg-blue-500 text-white' : 'bg-white text-blue-500'}`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        ></a>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}
