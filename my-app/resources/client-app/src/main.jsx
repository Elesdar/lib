import {StrictMode} from "react";
import {createRoot} from "react-dom/client";
import "./styles/index.scss";
import {BrowserRouter, Routes, Route} from "react-router";
import App from "./App.jsx";
import {HomePage} from "./routes/HomePage.jsx";
import {LoginPage} from "./routes/LoginPage.jsx";
import {RegistrationPage} from "./routes/RegistrationPage.jsx";
import {AuthLayout} from "./components/AuthLayout.jsx";
import {ProtectedLayout} from "./components/ProtectedLayout.jsx";
import {AuthProvider} from "./hooks/useAuth.jsx";
import {FormStoreBookPage} from "./routes/Forms/FormStoreBookPage.jsx";
import {BooksPage} from "./routes/BooksPage.jsx";
import {FormStoreCollectionPage} from "./routes/Forms/FormStoreCollectionPage.jsx";
import {CollectionsPage} from "./routes/CollectionsPage.jsx";
import {CollectionBooksPage} from "./routes/CollectionBooksPage.jsx";
import {LibraryPage} from "./routes/LibraryPage.jsx";

createRoot(document.getElementById('root')).render(
    <StrictMode>
        <BrowserRouter>
            <AuthProvider>
                <Routes>
                    <Route path="/" element={<App/>}/>
                    <Route element={<ProtectedLayout/>}>
                        <Route path="/home" element={<HomePage/>}/>
                        <Route path="/store-new-book" element={<FormStoreBookPage/>}/>
                        <Route path="/books" element={<BooksPage/>}/>
                        <Route path="/store-new-collection" element={<FormStoreCollectionPage/>}/>
                        <Route path="/collections" element={<CollectionsPage/>}/>
                        <Route path="/collections/:id" element={<CollectionBooksPage/>}/>
                        <Route path="/library" element={<LibraryPage/>}/>
                    </Route>
                    <Route element={<AuthLayout/>}>
                        <Route path="/login" element={<LoginPage/>}/>
                        <Route path="/registration" element={<RegistrationPage/>}/>
                    </Route>
                </Routes>
            </AuthProvider>
        </BrowserRouter>
    </StrictMode>,
)
