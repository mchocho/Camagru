function xhr(url, send=null, method="POST")
{
  return new Promise((resolve, reject) =>
  {
    const xhr = new XMLHttpRequest();

    xhr.onload = function()
    {
      console.log(xhr);

      if (xhr.status != 200)
        resolve(xhr)
      else
        reject(xhr);
    };

    xhr.open(method, url);
  	xhr.send(send);
  });
}