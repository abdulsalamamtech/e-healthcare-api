## Developed By Abdulsalam Amtech

## ehealthcare Website

content management system (CMS) that relies on MySQL (or MariaDB) as its database management system.

Below is an overview of the primary tables of the database schema along with their relationships:

### Key Tables and Descriptions

1. **users**
   - **Description:** Stores user data. (Has: roles, posts, comments, )
   - **Key Fields:**
     - `ID` (Primary Key)
     - `name`(Represent username)
     - `email`Index
     - `password` (hashed password)
     - `status`

2. **roles**
   - **Description:** Stores roles data.
   - **Key Fields:**
     - `ID` (Primary Key)
     - `role` Enum('user', 'super-admin', 'admin', 'editor', 'author','viewer')

    - 'user' - view posts and manage their own comments
    - 'super-admin' - manage the entire website
    - 'admin', - manage other users
    - 'editor' - manage entire posts
    - 'author', - mange their own post
    - 'viewer' - inspection only

            'super-admin' => ['super-admin', 'admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors','medical-officers', 'patients', 'emergencies'],
            'admin' => ['admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'partnerships' => ['partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'pharmacies' => ['pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'hospitals' => ['hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'],
            'doctors' => ['doctors', 'medical-officers', 'patients', 'emergencies'],
            'medical-officers' => ['medical-officers', 'patients', 'emergencies'],
            'patients' => ['patients', 'emergencies'],
            'emergencies' => ['patients', 'emergencies'],

3. **user_roles**
   - **Description:** Stores roles related to a user data. (Many to Many)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `user_id`
     - `role_id`

4. **images**
   - **Description:** Stores image data. (Belongs to posts)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `path` Nullable if url exist
     - `file_id`Nullable
     - `url` Nullable if path exist
     - `size` Nullable
     - `hosted_at` (AWS S3, Cloudinary, ImageInk)
     - `active` 

5. **user_infos** (This is optional)
   - **Description:** Stores users information data. (Belongs to user)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `user_id`
     - `image_id` (for user profile)
     - `first_name`
     - `last_name`
     - `phone_number`
     - `address`
     - `lga`
     - `state`
     - `country`
     - `active`

6. **posts**
   - **Description:** Stores post data. (Belongs to user, Has: categories, tags, comments)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `created_by` (User that write the post)
     - `image_id`   (The featured image)
     - `title`
     - `slug` Unique, Index
     - `content`
     - `views` (The numbers of views for this post)
     - `published_at` only when the status is published
     - `status` Enum('draft', 'published', 'archived') Default 'draft'
     - `active` Bool(true, false : if the post is approved)


7. **likes**
   - **Description:** Stores tags related to a post data. (Belongs to post, user)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `user_id`
     - `post_id`

8. **subscribers**
   - **Description:** Stores subscribers data. (Belongs to post, user)
   - **Key Fields:**
     - `ID` (Primary Key)
     - `email` Index
     - `active` Bool(true, false : if the user email is active)

     


## Others

**Use of google analytics**

**Use of storage sever**

