import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { Container, Typography, TextField, Button, Box } from '@mui/material';

export default function Create() {
    const [values, setValues] = useState({ name: '', email: '', password: '' });

    const handleChange = e => {
        setValues({ ...values, [e.target.name]: e.target.value });
    };

    const handleSubmit = e => {
        e.preventDefault();
        router.post('/users', values);
    };

    return (
        <Container sx={{ py: 4 }}>
            <Head title="Create User" />
            <Typography variant="h4" gutterBottom>
                Create User
            </Typography>
            <Box component="form" onSubmit={handleSubmit} sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
                <TextField name="name" value={values.name} onChange={handleChange} label="Name" />
                <TextField name="email" value={values.email} onChange={handleChange} label="Email" />
                <TextField type="password" name="password" value={values.password} onChange={handleChange} label="Password" />
                <Button type="submit" variant="contained">
                    Save
                </Button>
            </Box>
        </Container>
    );
}
