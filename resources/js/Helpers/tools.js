
var tools = {
  toCamelCase: (str) => {
    return str
      .replace(/\s(.)/g, function(a) {
          return a.toUpperCase();
      })
      .replace(/\s/g, '')
      .replace(/^(.)/, function(b) {
          return b.toLowerCase();
      });
  },
  toSlug: (str) => {
    return str.toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/[\s_-]+/g, '-').replace(/^-+|-+$/g, '')
  },
  listKey (object) {
    const id = object?.id ?? object?._id ?? object?.objectId
    const updatedAt = object?._updated_at ?? object?.updatedAt ?? object?.get('updatedAt')
    return `${id} ${updatedAt}`
  },
  // from input file to base64
  getBase64(file) {
    return new Promise((resolve, reject) => {
      if (!file) reject('No File')
      const reader = new FileReader()
      reader.readAsDataURL(file)
      reader.onloadend = () => {
        const base64String = reader.result
          .replace("data:", "")
          .replace(/^.+,/, "")
        resolve(base64String)
      }
      reader.onerror = error => reject(error)
    })
  },
  // from base64 to input file
  dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }

    return new File([u8arr], filename, {type:mime});
  },
  updateList (list, id, item) {
    const index = list.findIndex(function (element) {
      return id === element?.id??element?._id
    })
    list.splice(index, 1, item)
    return list
  },
  removeFromList (list, id) {
    const index = list.findIndex(function (element) {
      return id.trim() == (element?.id??element?._id ?? element?.objectId).trim()
    })
    list.splice(index, 1)
    return list
  },
  addtoList (list, item) {
    list.unshift(item)
    return list
  },
  incrementString(value) {
    let carry = 1
    let res = ''

    for (let i = value.length - 1; i >= 0; i--) {
      let char = value.toUpperCase().charCodeAt(i)
      char += carry
      if (char > 90) {
        char = 65
        carry = 1
      } else {
        carry = 0
      }
      res = String.fromCharCode(char) + res
      if (!carry) {
        res = value.substring(0, i) + res
        break
      }
    }
    if (carry) {
      res = 'A' + res
    }
    return res
  }
}

export { tools }