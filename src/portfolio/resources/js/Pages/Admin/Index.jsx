import React from 'react';
import { Link, Head } from '@inertiajs/react';
import {
    Container,
    Typography,
    Button,
    List,
    ListItem,
} from '@mui/material';

export default function Index({ admins }) {
    return (
        <Container sx={{ py: 4 }}>
            <Head title="Admins" />
            <Typography variant="h4" gutterBottom>
                Admins
            </Typography>
            <Button
                component={Link}
                href="/admins/create"
                variant="contained"
                sx={{ mb: 2 }}
            >
                Create Admin
            </Button>
            <List>
                {admins.map((admin) => (
                    <ListItem key={admin.id}>
                        {admin.name} ({admin.email})
                    </ListItem>
                ))}
            </List>
        </Container>
    );
}
