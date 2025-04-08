import { useForm } from '@inertiajs/react';

export default function Signup({ restaurant }: { restaurant: { id: number; name: string; address: string } }) {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        phone: '',
        restaurant_id: restaurant.id,
    });

    function handleSubmit(e: React.FormEvent) {
        e.preventDefault();
        post(`/membership/signup/${restaurant.id}`);
    }
    console.log('Restaurant ID:', restaurant.id);
    

    return (
        <div className="mx-auto max-w-lg p-4">
            <h1 className="mb-4 text-2xl font-bold">Sign Up for {restaurant.name}</h1>
            <p className="mb-4 text-sm text-gray-600">{restaurant.address}</p>

            <form onSubmit={handleSubmit}>
                <div className="mb-4">
                    <label htmlFor="name" className="block text-sm font-bold mb-2">Name</label>
                    <input
                        type="text"
                        name="name"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.name && <p className="text-red-500 text-xs mt-1">{errors.name}</p>}
                </div>
                <div className="mb-4">
                    <label htmlFor="email" className="block text-sm font-bold mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email}</p>}
                </div>
                <div className="mb-4">
                    <label htmlFor="phone" className="block text-sm font-bold mb-2">Phone</label>
                    <input
                        type="tel"
                        name="phone"
                        value={data.phone}
                        onChange={(e) => setData('phone', e.target.value)}
                        required
                        className="w-full border rounded px-3 py-2"
                    />
                    {errors.phone && <p className="text-red-500 text-xs mt-1">{errors.phone}</p>}
                </div>
                <button type="submit" disabled={processing} className="w-full bg-blue-500 text-white font-bold py-2 rounded">
                    Sign Up
                </button>
            </form>
        </div>
    );
}