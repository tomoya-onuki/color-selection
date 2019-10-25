const jsFrame = new JSFrame();
document.getElementById("save").onclick = function() {
  jsFrame.showToast({
      duration: 2000,//表示時間(millis)
      html: '保存しました'
  });
}
