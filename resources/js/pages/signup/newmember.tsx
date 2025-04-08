// frontend that allows users to signup as a member for a one specific restaurant

import AppLayout from '@/layouts/app-layout';
import { Head } from '@inertiajs/react';

function Newmember({ restaurants }: { restaurants: any[] }) {
    console.log(restaurants);
    return (
        // show the restaurant's details
        <AppLayout>
            <Head title="New Member" />
            {/* show a restaurant details */}
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    {restaurants.map((restaurant) => (
                        <div key={restaurant.id} className="rounded-lg bg-white p-4 shadow-md">
                            <h2 className="text-lg font-semibold">{restaurant.name}</h2>
                            <p>{restaurant.description}</p>
                            <p>{restaurant.address}</p>
                            <p>{restaurant.phone}</p>
                            <p>{restaurant.email}</p>
                        </div>
                    ))}
                </div>
            </div>
        </AppLayout>
    );
}

export default Newmember;
