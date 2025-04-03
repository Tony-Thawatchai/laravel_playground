import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/react';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Todos',
        href: '/todos',
    },
    {
        title: 'Create Todo',
        href: '/todos/create',
    },
];

interface User {
    id: number;
    name: string;
    email: string;
}

export default function CreateTodo({ users }: { users: User[] }) {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        description: '',
        due_date: '',
        user_id: '', // Initialize user_id in the form state
    });

    function handleSubmit(e: React.FormEvent) {
        e.preventDefault();
        post('/todos/create'); // Submit the form to the backend
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create Todo" />
            <form onSubmit={handleSubmit} className="max-w-lg mx-auto p-4">
                <div className="mb-4">
                    <label className="block text-sm font-bold mb-2">Title</label>
                    <input
                        type="text"
                        value={data.title}
                        onChange={(e) => setData('title', e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.title && <p className="text-red-500 text-xs mt-1">{errors.title}</p>}
                </div>
                <div className="mb-4">
                    <label className="block text-sm font-bold mb-2">Description</label>
                    <textarea
                        value={data.description}
                        onChange={(e) => setData('description', e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    ></textarea>
                    {errors.description && <p className="text-red-500 text-xs mt-1">{errors.description}</p>}
                </div>
                <div className="mb-4">
                    <label className="block text-sm font-bold mb-2">Due Date</label>
                    <input
                        type="date"
                        value={data.due_date}
                        onChange={(e) => setData('due_date', e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.due_date && <p className="text-red-500 text-xs mt-1">{errors.due_date}</p>}
                </div>
                <div className="mb-4">
                    <label className="block text-sm font-bold mb-2">Assigned User</label>
                    <select
                        value={data.user_id}
                        onChange={(e) => setData('user_id', e.target.value)}
                        className="w-full border rounded px-3 py-2"
                    >
                        <option value="">Select a user</option>
                        {users.map((user) => (
                            <option key={user.id} value={user.id}>
                                {user.name}
                            </option>
                        ))}
                    </select>
                    {errors.user_id && <p className="text-red-500 text-xs mt-1">{errors.user_id}</p>}
                </div>

                <button
                    type="submit"
                    disabled={processing}
                    className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                >
                    Create Todo
                </button>
            </form>
        </AppLayout>
    );
}