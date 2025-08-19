import React from 'react';
import { Link, Head } from '@inertiajs/react';
import {
    Container,
    Typography,
    Button,
    List,
    ListItem,
} from '@mui/material';

export default function Index({ users }) {
    return (
        <Container sx={{ py: 4 }}>
            <Head title="Users" />
            <Typography variant="h4" gutterBottom>
                Users
            </Typography>
            <Button
                component={Link}
                href="/users/create"
                variant="contained"
                sx={{ mb: 2 }}
            >
                Create User
            </Button>
            <List>
                {users.map((user) => (
                    <ListItem key={user.id}>
                        {user.name} ({user.email})
                    </ListItem>
                ))}
            </List>
        </Container>
    );
}
