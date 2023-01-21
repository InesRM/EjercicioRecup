

const urlRegister = "http://127.0.0.1:8000/api/register";
const urlLogin = "http://127.0.0.1:8000/api/login";
const urlLogOut = "http://127.0.0.1:8000/api/logout";
const urlUsers = "http://127.0.0.1:8000/api/user/users";
const urlUpdatePassword = "http://127.0.0.1:8000/api/user/update";
const urlUpdateAttributes = "http://127.0.0.1:8000/api/user/updateattributes";
const urlGenerateUsers = "http://127.0.0.1:8000/api/user/create";
const urlDeleteUser = "http://127.0.0.1:8000/api/user/delete";
const urlGetAttributes = "http://127.0.0.1:8000/api/user/getattributes";
const urlUploadAvatar = "http://localhost:8000/api/image/store";
const urlGetAvatar = "http://localhost:8000/api/image/getAvatar/";
const urlGetAvatarUrl = "http://localhost:8000/api/image/getAvatarUrl/";
const urlUpdateAvatar = "http://localhost:8000/api/image/updateStore/";

export const uploadAvatar = async (file) => {
  const formData = new FormData();
  formData.append("file", file);
try{
  const response = await fetch(urlUploadAvatar, {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  return  data.secure_url;

} catch(err){
  throw err;
}
};

export const getAvatar = async (id) => {
  try {
    const response = await fetch(urlGetAvatar + id);
    if (!response.ok) throw "No se pudo realizar la peticion";
    const avatar = await response.json();
    return avatar;
  }
  catch (err) {
    throw err;
  }
};

export const getAvatarUrl = async (id) => {
  try {
    const response = await fetch(urlGetAvatarUrl + id);
    if (!response.ok) throw "No se pudo realizar la peticion";
    const avatar = await response.json();
    return avatar;
  }
  catch (err) {
    throw err;
  }
};

export const updateAvatar = async (avatar) => {
  const response = await fetch(urlUpdateAvatar, {
    method: "PUT",
    body: JSON.stringify(avatar),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};


export const registrar = async (usuario) => {
  const response = await fetch(urlRegister, {
    method: "POST",
    body: JSON.stringify(usuario),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};

export const verUsuarios = async () => {
  try {
    const response = await fetch(urlUsers);
    if (!response.ok) throw "No se pudo realizar la peticion";
    const usuario = await response.json();
    return usuario;
  } catch (err) {
    throw err;
  }
};

export const login = async (usuario) => {
  const response = await fetch(urlLogin, {
    method: "POST",
    body: JSON.stringify(usuario),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};

export const logOut = async (usuario) => {
  const response = await fetch(urlLogOut, {
    method: "POST",
    body: JSON.stringify(usuario),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};

export const updatePassword = async (data) => {
  const response = await fetch(urlUpdatePassword, {
    method: "PUT",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};

export const updateAttributes = async (data) => {
  const response = await fetch(urlUpdateAttributes, {
    method: "PUT",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
    },
  });
  return await response.json();
};

export const generateUsers = async (data) => {
  try {
    const response = await fetch(
      urlGenerateUsers + "/" + data.id + "/" + data.number
    );
    if (!response.ok) throw "No se pudo realizar la peticion";
    return await response.json();
  } catch (err) {
    throw err;
  }
};

export const deleteUser = async (id) => {
  try {
    const response = await fetch(urlDeleteUser + "/" + id);
    if (!response.ok) throw "No se pudo realizar la peticion";
    return await response.json();
  } catch (err) {
    throw err;
  }
};

export const getAttributes = async (id) => {
  try {
    const response = await fetch(urlGetAttributes + "/" + id);
    if (!response.ok) throw "No se pudo realizar la peticion";
    return await response.json();
  } catch (err) {
    throw err;
  }
};


