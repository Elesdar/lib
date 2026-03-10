import "../../styles/routes/form.scss";
import React, {useState} from "react";
import {useNavigate} from "react-router";
import {apiClient} from "../../api/apiClient.jsx";

export const FormStoreCollectionPage = () => {
    const [validationErrors, setValidationErrors] = useState({});
    const [error, setError] = useState('');
    const [fileValidationErrors, setFileValidationErrors] = useState({});
    const [fileError, setFileError] = useState('');
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [cover, setCover] = useState('');
    const [coverId, setCoverId] = useState('');

    const navigate = useNavigate();

    const handleFormStoreCollection = async (e) => {
        e.preventDefault();

        try {
            const response = await apiClient.post('/api/collections',
                {title, cover_id: coverId, description}, {});
            navigate('/collections');
        } catch (error) {
            if (error.status === 403) {
                window.location = '/login';
            }
            if (error.response && error.response.status === 422) {
                setValidationErrors(error.response.data.errors);
            } else {
                setError(error.response?.data?.errors || 'Произошла ошибка! Попробуйте позже');
            }
        }
    };

    const saveAttachment = async (e) => {
        setFileError('');
        setFileValidationErrors({});
        try {
            const formData = new FormData();
            formData.append('file', e.target.files[0]);
            formData.append('group', 'cover');
            formData.append('model', 'Collection');
            setCover(e.target.value);

            const response = await apiClient.post('/api/file', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            setCoverId(response.data);
        } catch (error) {
            if (error.status === 403) {
                window.location = '/login';
            }
            if (error.response && error.response.status === 422) {
                setFileValidationErrors(error.response.data.errors);
            } else {
                setFileError(error.response?.data?.errors || 'Не получилось загрузить файл');
            }
        }
    };

    return (
        <div className="main-form">
            <div className="form">
                <div className="form-title">Добавьте новую коллекцию</div>
                <form onSubmit={handleFormStoreCollection}>
                    <div className="field">
                        {validationErrors.title && validationErrors.title.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Название" required
                            value={title}
                            onChange={(e) => setTitle(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.description && validationErrors.description.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <textarea
                            name="description"
                            id="description"
                            placeholder="Описание"
                            value={description}
                            rows="4"
                            onChange={(e) => setDescription(e.target.value)}
                        />
                    </div>
                    <div className="field">
                        {validationErrors.cover_id && validationErrors.cover_id.map((msg, index) => (
                            <div className="error" key={index}>{msg}</div>
                        ))}
                        <div className="input-file">
                            <input
                                type="file"
                                name="cover"
                                id="cover"
                                value={cover}
                                className='file-input-hidden'
                                onChange={(e) => saveAttachment(e)}
                            />
                            <label htmlFor="cover" className="upload-label">
                                Выбрать обложку
                            </label>
                            <span className="file-name-text">{cover || 'Файл не выбран'}</span>
                        </div>
                        <div className="error">
                            {fileValidationErrors.file && fileValidationErrors.file.map((msg, index) => (
                                <p className="error" key={index}>{msg}</p>
                            ))}
                            {fileError && <p className="error">{fileError}</p>}
                        </div>
                    </div>
                    <div className="submit">
                        <button type="submit">Сохранить</button>
                    </div>
                    <div className="error">
                        {error && <p className="error">{error}</p>}
                    </div>
                </form>
            </div>
        </div>
    );
};
