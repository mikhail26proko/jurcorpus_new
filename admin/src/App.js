import * as React from "react";
import { Admin, Resource} from 'react-admin';
import jsonServerProvider from 'ra-data-json-server';
import { UserList } from './Component/User';
import { PostCreate, PostEdit, PostList } from './Component/Post';
import Dashboard from './Component/Dashboard';
import authProvider from './Provider/authProvider';

import UserIcon from '@mui/icons-material/Group';
import PostIcon from '@mui/icons-material/Book';

const dataProvider = jsonServerProvider('https://jsonplaceholder.typicode.com');

const App = () => (
    <Admin dashboard={Dashboard} authProvider={authProvider} dataProvider={dataProvider}>
        <Resource name="users" list={UserList} icon={UserIcon}/>
        <Resource name="posts" create={PostCreate} edit={PostEdit} list={PostList} icon={PostIcon} />
    </Admin>
);
export default App;