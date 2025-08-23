export interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    created_at: string;
    updated_at: string;
    parent_id: number | null;
    status: string;
}
export interface CategoryProps {
    categories: {
        data: Category[];
        meta: {
            current_page: number;
            from: number;
            last_page: number;
            per_page: number;
            to: number;
            total: number;
        };
        links: {
            url: string | null;
            label: string;
            active: boolean;
        }[];
    }
}
