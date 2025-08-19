import * as React from 'react';
import { Button, Container, Typography } from '@mui/material';

export default function Welcome() {
    return (
        <Container sx={{ mt: 4 }}>
            <Typography variant="h4" gutterBottom>
                ポートフォリオへようこそ！
            </Typography>
            <Button variant="contained" color="primary">
                はじめる
            </Button>
        </Container>
    );
}