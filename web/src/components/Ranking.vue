<template>
  <div class="ranking py-10 px-6">
    <div class="container mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">排行榜</h2>
        <div class="flex space-x-2">
          <button 
            v-for="category in categories" 
            :key="category.id"
            class="px-4 py-2 rounded-full text-sm"
            :class="{ 'bg-primary text-white': activeCategory === category.id, 'bg-gray-200 hover:bg-gray-300': activeCategory !== category.id }"
            @click="activeCategory = category.id"
          >
            {{ category.name }}
          </button>
        </div>
      </div>
      
      <div class="grid grid-cols-5 gap-6">
        <div class="col-span-4">
          <div class="grid grid-cols-5 gap-4">
            <div 
              v-for="(video, index) in currentCategoryVideos" 
              :key="video.id"
              class="video-item"
            >
              <div class="relative">
                <div class="absolute top-2 left-2 bg-primary text-white w-6 h-6 flex items-center justify-center rounded-full text-sm font-bold">
                  {{ index + 1 }}
                </div>
                <img 
                  :src="video.cover" 
                  :alt="video.title"
                  class="w-full h-48 object-cover rounded"
                />
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-2">
                  <p class="text-white text-sm font-medium truncate">{{ video.title }}</p>
                </div>
              </div>
              <div class="mt-2">
                <p class="text-sm font-medium truncate">{{ video.title }}</p>
                <p class="text-xs text-gray-500">更新至第{{ video.episode || 12 }}集</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-span-1">
          <div class="bg-white rounded-lg p-4 shadow">
            <h3 class="text-lg font-bold mb-4">热门标签</h3>
            <div class="flex flex-wrap gap-2">
              <button 
                v-for="tag in tags" 
                :key="tag.id"
                class="px-3 py-1 rounded-full text-sm bg-gray-100 hover:bg-primary hover:text-white transition-colors"
              >
                {{ tag.name }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'

// 分类数据
const categories = ref([
  { id: '1', name: '电影' },
  { id: '2', name: '电视剧' },
  { id: '3', name: '综艺' },
  { id: '4', name: '动漫' },
  { id: '5', name: '短剧' }
])

// 标签数据
const tags = ref([
  { id: '1', name: '动作' },
  { id: '2', name: '喜剧' },
  { id: '3', name: '科幻' },
  { id: '4', name: '悬疑' },
  { id: '5', name: '爱情' },
  { id: '6', name: '奇幻' },
  { id: '7', name: '冒险' },
  { id: '8', name: '武侠' },
  { id: '9', name: '战争' },
  { id: '10', name: '纪录片' }
])

// 模拟视频数据
const videos = ref({
  '1': [
    { id: '101', title: '复仇者联盟4：终局之战', cover: 'https://via.placeholder.com/200x300?text=Avengers+4', episode: 1 },
    { id: '102', title: '阿凡达：水之道', cover: 'https://via.placeholder.com/200x300?text=Avatar+2', episode: 1 },
    { id: '103', title: '泰坦尼克号', cover: 'https://via.placeholder.com/200x300?text=Titanic', episode: 1 },
    { id: '104', title: '星球大战：天行者的崛起', cover: 'https://via.placeholder.com/200x300?text=Star+Wars', episode: 1 },
    { id: '105', title: '侏罗纪世界3', cover: 'https://via.placeholder.com/200x300?text=Jurassic+World', episode: 1 },
    { id: '106', title: '速度与激情9', cover: 'https://via.placeholder.com/200x300?text=Fast+Furious', episode: 1 },
    { id: '107', title: '蜘蛛侠：英雄无归', cover: 'https://via.placeholder.com/200x300?text=Spider+Man', episode: 1 },
    { id: '108', title: '奇异博士2：疯狂多元宇宙', cover: 'https://via.placeholder.com/200x300?text=Doctor+Strange', episode: 1 },
    { id: '109', title: '雷神4：爱与雷霆', cover: 'https://via.placeholder.com/200x300?text=Thor+4', episode: 1 },
    { id: '110', title: '黑豹2：瓦坎达万岁', cover: 'https://via.placeholder.com/200x300?text=Black+Panther', episode: 1 }
  ],
  '2': [
    { id: '201', title: '权力的游戏', cover: 'https://via.placeholder.com/200x300?text=Game+of+Thrones', episode: 73 },
    { id: '202', title: '绝命毒师', cover: 'https://via.placeholder.com/200x300?text=Breaking+Bad', episode: 62 },
    { id: '203', title: '老友记', cover: 'https://via.placeholder.com/200x300?text=Friends', episode: 236 },
    { id: '204', title: '生活大爆炸', cover: 'https://via.placeholder.com/200x300?text=Big+Bang+Theory', episode: 279 },
    { id: '205', title: '纸牌屋', cover: 'https://via.placeholder.com/200x300?text=House+of+Cards', episode: 73 },
    { id: '206', title: '行尸走肉', cover: 'https://via.placeholder.com/200x300?text=Walking+Dead', episode: 177 },
    { id: '207', title: '西部世界', cover: 'https://via.placeholder.com/200x300?text=Westworld', episode: 28 },
    { id: '208', title: '怪奇物语', cover: 'https://via.placeholder.com/200x300?text=Stranger+Things', episode: 34 },
    { id: '209', title: '王冠', cover: 'https://via.placeholder.com/200x300?text=Crown', episode: 50 },
    { id: '210', title: '黑镜', cover: 'https://via.placeholder.com/200x300?text=Black+Mirror', episode: 22 }
  ],
  '3': [
    { id: '301', title: '奔跑吧兄弟', cover: 'https://via.placeholder.com/200x300?text=Running+Man', episode: 100 },
    { id: '302', title: '极限挑战', cover: 'https://via.placeholder.com/200x300?text=Extreme+Challenge', episode: 80 },
    { id: '303', title: '中国好声音', cover: 'https://via.placeholder.com/200x300?text=Voice+of+China', episode: 60 },
    { id: '304', title: '快乐大本营', cover: 'https://via.placeholder.com/200x300?text=Happy+Camp', episode: 1000 },
    { id: '305', title: '王牌对王牌', cover: 'https://via.placeholder.com/200x300?text=Ace+vs+Ace', episode: 50 },
    { id: '306', title: '向往的生活', cover: 'https://via.placeholder.com/200x300?text=Back+to+Field', episode: 40 },
    { id: '307', title: '爸爸去哪儿', cover: 'https://via.placeholder.com/200x300?text=Where+Are+We+Going+Dad', episode: 30 },
    { id: '308', title: '花儿与少年', cover: 'https://via.placeholder.com/200x300?text=Divas+Hit+the+Road', episode: 20 },
    { id: '309', title: '真正男子汉', cover: 'https://via.placeholder.com/200x300?text=Real+Men', episode: 20 },
    { id: '310', title: '偶像练习生', cover: 'https://via.placeholder.com/200x300?text=Idol+Producer', episode: 12 }
  ],
  '4': [
    { id: '401', title: '海贼王', cover: 'https://via.placeholder.com/200x300?text=One+Piece', episode: 1000 },
    { id: '402', title: '火影忍者', cover: 'https://via.placeholder.com/200x300?text=Naruto', episode: 720 },
    { id: '403', title: '进击的巨人', cover: 'https://via.placeholder.com/200x300?text=Attack+on+Titan', episode: 75 },
    { id: '404', title: '鬼灭之刃', cover: 'https://via.placeholder.com/200x300?text=Demon+Slayer', episode: 45 },
    { id: '405', title: '我的英雄学院', cover: 'https://via.placeholder.com/200x300?text=My+Hero+Academia', episode: 113 },
    { id: '406', title: '东京食尸鬼', cover: 'https://via.placeholder.com/200x300?text=Tokyo+Ghoul', episode: 48 },
    { id: '407', title: '进击的巨人', cover: 'https://via.placeholder.com/200x300?text=Attack+on+Titan', episode: 75 },
    { id: '408', title: '银魂', cover: 'https://via.placeholder.com/200x300?text=Gintama', episode: 367 },
    { id: '409', title: '龙珠超', cover: 'https://via.placeholder.com/200x300?text=Dragon+Ball+Super', episode: 131 },
    { id: '410', title: '一拳超人', cover: 'https://via.placeholder.com/200x300?text=One+Punch+Man', episode: 24 }
  ],
  '5': [
    { id: '501', title: '赘婿', cover: 'https://via.placeholder.com/200x300?text=Zhui+Xu', episode: 30 },
    { id: '502', title: '琉璃', cover: 'https://via.placeholder.com/200x300?text=Liu+Li', episode: 59 },
    { id: '503', title: '锦衣之下', cover: 'https://via.placeholder.com/200x300?text=Jin+Yi+Zhi+Xia', episode: 55 },
    { id: '504', title: '传闻中的陈芊芊', cover: 'https://via.placeholder.com/200x300?text=Chen+Qian+Qian', episode: 24 },
    { id: '505', title: '三千鸦杀', cover: 'https://via.placeholder.com/200x300?text=San+Qian+Ya+Sha', episode: 30 },
    { id: '506', title: '离人心上', cover: 'https://via.placeholder.com/200x300?text=Li+Ren+Xin+Shang', episode: 35 },
    { id: '507', title: '将军家的小娘子', cover: 'https://via.placeholder.com/200x300?text=Jiang+Jun+Jia+De+Xiao+Niang+Zi', episode: 30 },
    { id: '508', title: '小女花不弃', cover: 'https://via.placeholder.com/200x300?text=Xiao+Nv+Hua+Bu+Qi', episode: 51 },
    { id: '509', title: '双世宠妃', cover: 'https://via.placeholder.com/200x300?text=Shuang+Shi+Chong+Fei', episode: 30 },
    { id: '510', title: '绝世千金', cover: 'https://via.placeholder.com/200x300?text=Jue+Shi+Qian+Jin', episode: 30 }
  ]
})

const activeCategory = ref('4') // 默认选中动漫分类

// 当前分类的视频
const currentCategoryVideos = computed(() => {
  return videos.value[activeCategory.value] || []
})
</script>

<style scoped>
.ranking {
  background-color: white;
}

.video-item {
  transition: transform 0.3s ease;
}

.video-item:hover {
  transform: translateY(-5px);
}
</style>
